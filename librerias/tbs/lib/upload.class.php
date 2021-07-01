<?php
/**
 *
 * Class FileUpload
 * This will help multiple number of file uploads
 * Users will be able to create as many file uploads as they want
 * @Author sabincv@gmail.com - Sabin Cheruvattil
 *
 *
 **/
class FileUpload
{
	/*
	 *
	 * @param name - name of the file upload field
	 * 
	 **/
	var $name;
	
	/**
	 *
	 * @params buffer - will store the code for display
	 *
	 **/
	var $buffer;
	
	/**
	 *
	 * @params container - id of the container table
	 *
	 **/
	var $container;
	
	/**
	 *
	 * @params directory - directory to which files are moved
	 *
	 **/
	var $directory;
	
	/**
	 *
	 * @params error - errors present
	 *
	 **/
	var $error;
	
	/**
	 *
	 * @params allowedFiles - file types allowed for upload
	 *
	 **/
	var $allowedFiles;
	
	/**
	 *
	 * @params maxFileSize - file size allowed for single upload
	 *
	 **/
	var $maxFileSize;
	
	function __construct($name, $container = 'fileTable', $directory = 'uploads/')
	{
		$this->name = $name;
		$this->container = $container;
		$this->directory = $directory;
		if(!file_exists($this->directory)) {
			if(!mkdir($this->directory)) {
				$this->error = 'Unable To Create Target Directory';
			}
		}
		// 500 KB maximum upload size
		$this->maxFileSize = 512000;
		$this->allowedFiles = array('jpg', 'jpeg', 'bmp', 'png', 'gif', 'swf');
	}
	
	/**
	 *
	 * function display will display the contents to the page.
	 * will return error incase the directory creation failed
	 *
	**/
	function display()
	{
		echo $this->error;
		if(!$this->error) {
			$this->buffer = $this->getScript();
			$this->buffer .= $this->getBaseTable();
			print_r($this->buffer);
		} else {
			return false;
		}
	}
	
	/**
	 *
	 * private function getScript() will give the JS code for the Upload
	 *
	**/
	private function getScript()
	{
		$script =	"<script type=\"text/javascript\">
					function addFileRow(id){
					  var tbody = document.getElementById(id).getElementsByTagName(\"TBODY\")[0];
					  var row = document.createElement(\"TR\");
					  var firsCol = document.createElement(\"TD\");
					  
					  var inputFile = document.createElement(\"Input\");
					  inputFile.type = \"file\";
					  rowid = Math.floor(Math.random() * 999999999)
					  inputFile.id = 'file_' + rowid;
					  inputFile.name = '" . $this->name . '[]' . "';
					  inputFile.setAttribute('onClick', \"javascript:addFileRow('" . $this->container . "')\");
					  firsCol.appendChild(inputFile);
					  
					  row.setAttribute(\"id\", \"fileRow_\" + rowid);
					  
					  var trdCol2 = document.createElement(\"TD\");
					  var RemTextObj = document.createElement(\"BUTTON\");
					  RemTextObj.setAttribute('onClick', \"document.getElementById(\'file_\'+rowid).click();\");
					  RemTextObj.type = 'button';
					  RemTextObj.innerHTML = '<img src=\"images/add.png\">';
					  trdCol2.appendChild(RemTextObj);
					 
					  var trdCol = document.createElement(\"TD\");
					  var RemTextObj = document.createElement(\"A\");
					  url = \"javascript:removeFileRow('" . $this->container . "', \" + parseInt(rowid) + \");\";
					  RemTextObj.setAttribute(\"href\", url);
					  RemTextObj.innerHTML = '<button type=\"button\"><img src=\"images/remove.png\"></button>';
					  trdCol.appendChild(RemTextObj);
					  
					  row.appendChild(firsCol);
					  row.appendChild(trdCol2);
					  row.appendChild(trdCol);
					  tbody.appendChild(row);
				  }
				  
				  function removeFileRow(id, rowId) 
				  {
					  var tbody = document.getElementById(id).getElementsByTagName(\"TBODY\")[0];
					  if(document.getElementById(id).rows.length > 1) {
						  var delRowId = 'fileRow_' + rowId;
						  var delRow = document.getElementById(delRowId);
						  tbody.removeChild(delRow);
					  }
				  }</script>";
		return $script;
	}
	
	/**
	 *
	 * private function getBaseTable() will give the container for the file upload
	 *
	**/
	private function getBaseTable_()
	{
		return "<table id='" . $this->container . "'><tbody>" . 
				"<tr id=\"fileRow_0\">
					<!--<td>File 1</td>-->
					<td><input type=\"file\" id=\"file_0\" name='" . $this->name . '[]' . "'onClick=\"javascript:addFileRow('" . $this->container . "')\"></td>
					<td><a href=\"javascript:removeFileRow('" . $this->container . "', 0)\" style=\"text-decoration:none;color:#000\">[-]</a>
					&nbsp;
					&nbsp;
					&nbsp;
					&nbsp;
					<button type='button' onclick='document.getElementById(\"file_0\").click();'>test</button>
					</td>
				 </tr></tbody></table>";
	}
	
	private function getBaseTable()
	{
		return "<table id='" . $this->container . "'><tbody>" . 
				"<tr id=\"fileRow_0\">
					<!--<td>File 1</td>-->
					<td><input type=\"file\" id=\"file_0\" name='" . $this->name . '[]' . "' onClick=\"javascript:addFileRow('" . $this->container . "')\"></td>
					<td>
					<button type='button' onclick='document.getElementById(\"file_0\").click();'><img src=\"images/add.png\"></button>
					<!--
					<button type='button' onclick=\"javascript:removeFileRow('" . $this->container . "', 0);\"><img src=\"images/remove.png\"></button>
					-->
					&nbsp;
					</td>
				 </tr></tbody></table>";
	}
	
	/**
	 *
	 * function handle() will move the uploaded files
	 * It will check for the uploaded file types.
	 * if files are not supported, it will ignore it
	 *
	**/
	function handle()
	{
		$val = true;
		if(!empty($_FILES)) {
			foreach($_FILES[$this->name]['error'] as $key => $error) {
				if($error == 0) {
					$info = pathinfo($_FILES[$this->name]['name'][$key]);
					if(array_intersect($this->allowedFiles, array(strtolower($info['extension']))) &&
						$_FILES[$this->name]['size'][$key] <= $this->maxFileSize)  {
						srand();
						$rand = rand(0, time() . $_FILES[$this->name]['name'][$key]);
						$newFile = $this->directory . md5($rand) . '.'. $info['extension'];
						move_uploaded_file($_FILES[$this->name]['tmp_name'][$key], $newFile);
					}else{
						$val = false;
					}
				}
			}
			if($val){
				return "<div style='width:300px;font-family:verdana;font-size:12px;border:#ff0000 1px solid; background-color:#FBF3B3;margin:1px;padding:2px;'>
						Archivos subidos con exito!<br>
						</div>";
			}else{
				return "<div style='width:400px;font-family:verdana;font-size:12px;border:#ff0000 1px solid; background-color:#FBF3B3;margin:5px;padding:2px;'>
						Algunos archivos no fueron cargados.<br>
						Solo se permiten archivos de excel 97-2003 / en formato .xls<br>
						El tama&ntilde;o no debe superar los 500Kb.<br>
					   </div>";
			}
		}
	}
}

?>