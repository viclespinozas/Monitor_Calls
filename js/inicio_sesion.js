$(function() {
    
	function runEffect(ef,con) {
      var selectedEffect = ef;
 
      var options = {};
      if ( selectedEffect === "scale" ) {
        options = { percent: 0 };
      } else if ( selectedEffect === "transfer" ) {
        options = { to: "#button", className: "ui-effects-transfer" };
      } else if ( selectedEffect === "size" ) {
        options = { to: { width: 200, height: 60 } };
      }
 
      $( "#"+con+"" ).effect( selectedEffect, options, 500, callback );
    };
	
	function runEffect2(ef,con) {
      var selectedEffect = ef
 
      var options = {};
      if ( selectedEffect === "scale" ) {
        options = { percent: 100 };
      } else if ( selectedEffect === "size" ) {
        options = { to: { width: 280, height: 185 } };
      }
 
      $( "#"+con+"" ).show( selectedEffect, options, 500 );
    };
 
    function callback() {
		locateDialog();
		runEffect2('puff','main');
        return false;
	};
 
    // set effect from select menu value
    $( "#lock_center" ).click(function() {
      runEffect('puff','lock_center');
      return false;
    });
	
	$( "#button" ).click(function() {
      validarUsuario('1');
      return false;
    });

    $( "#buttonvp" ).click(function() {
      validarUsuario('2');
      return false;
    });
	
  });

function getSize(){
	var winW = 630, winH = 460;
	if (document.body && document.body.offsetWidth) {
	 winW = document.body.offsetWidth;
	 winH = document.body.offsetHeight;
	}
	if (document.compatMode=='CSS1Compat' &&
		document.documentElement &&
		document.documentElement.offsetWidth ) {
	 winW = document.documentElement.offsetWidth;
	 winH = document.documentElement.offsetHeight;
	}
	if (window.innerWidth && window.innerHeight) {
	 winW = window.innerWidth;
	 winH = window.innerHeight;
	}
	var widthR = (winW/2) - 70;
	var heightR = (winH/2) - 70;
	
	document.getElementById('lock_center').style.left = widthR;
	document.getElementById('lock_center').style.top = heightR;
}

function locateDialog(){
	var winW = 630, winH = 460;
	if (document.body && document.body.offsetWidth) {
	 winW = document.body.offsetWidth;
	 winH = document.body.offsetHeight;
	}
	if (document.compatMode=='CSS1Compat' &&
		document.documentElement &&
		document.documentElement.offsetWidth ) {
	 winW = document.documentElement.offsetWidth;
	 winH = document.documentElement.offsetHeight;
	}
	if (window.innerWidth && window.innerHeight) {
	 winW = window.innerWidth;
	 winH = window.innerHeight;
	}
	var widthR = (winW/2) - 200;
	var heightR = (winH/2) - 150;
	
	document.getElementById('main').style.left = widthR;
	document.getElementById('main').style.top = heightR;
}

function validarUsuario(p){
	var usuario = $( "#usuario" ),
		password = $( "#password" ),
		allFields = $( [] ).add( name ).add( password ),
		tips = $( ".validateTips" );
		profile = p;
	 
	function updateTips( t ) {
	  tips
		.text( t )
		.addClass( "ui-state-highlight" );
	  setTimeout(function() {
		tips.removeClass( "ui-state-highlight", 1500 );
	  }, 500 );
	}
 
	function checkLength( o, n ) {
	  if ( o.val().length == 0 ) {
		o.addClass( "ui-state-error" );
		updateTips(  n + " en blanco, por favor verifique." );
		return false;
	  } else {
		return true;
	  }
	}
 
	function checkRegexp( o, regexp, n ) {
	  if ( !( regexp.test( o.val() ) ) ) {
		o.addClass( "ui-state-error" );
		updateTips( n );
		return false;
	  } else {
		return true;
	  }
	}
 
	var bValid = true;
	allFields.removeClass( "ui-state-error" );

	bValid = bValid && checkLength( usuario, "El usuario" );
	bValid = bValid && checkLength( password, "La contrasena" );
 
	if ( bValid ) {
	  //$( this ).dialog( "close" );
	  xajax_validaUsuario(xajax.getFormValues('form'),profile);
	}
}


