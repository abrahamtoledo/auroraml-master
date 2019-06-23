/*
 * transforms.js
 * 
 * Realiza las transformaciones necesarias a las paginas
 * dependencias:
 * 		jQuery - v1.10.2 
 * 		jQueryMobile v1.4.0-rc.1
 * 
 */

var RegExpUtils = {
	scapeReplacement: function(s){
		return s.replace(/\$/g, '$$$$');
	},
	scapeString: function(s){
		return s.replace(/[-\/\^$*+?.()|\[\]\{\}]/g, '\\$&');
	},
	
};

var settings={};
settings.serviceRootUri = "http://"+ (gHost || "127.0.0.1:30000")  +"/";
settings.servicePrefixPattern = new RegExp('^' + RegExpUtils.scapeString(settings.serviceRootUri), 'i');


/**
 * Bootstrap: Esto es llamado cuando el documento esta listo
 */
$(function(){
	setPrefixEnabled(true);
});

/**
 * Agrega o elimina el prefijo a los enlaces y formularios de la pagina
 * @param {boolean} enabled si es true agregar prefijo, si no quitar el prefijo
 */
function setPrefixEnabled(enabled){
	
	// Enlaces
	$("a[href^='http:'], a[href^='https:']").each(function (i, v){
		var oV = $(v);
		var link = oV.attr("href");
		
		if (enabled && !link.match(settings.servicePrefixPattern)){
			oV.attr("href", settings.serviceRootUri + link);
			//oV.attr({target: 'dummy'});
		}
		
		if (!enabled && link.match(settings.servicePrefixPattern)){
			link = link.replace(settings.servicePrefixPattern, "");
			oV.attr("href", link);
		}
		
		
	});
	
	// Formularios
	$("form[action^='http:'], form[action^='https:']").each(function (i, v){
		var oV = $(v);
		var link = oV.attr("action");
		
		if (enabled && !link.match(settings.servicePrefixPattern)){
			oV.attr("action", settings.serviceRootUri + link);
			//oV.attr({target: 'dummy'});
		}
		
		
		if (!enabled && link.match(settings.servicePrefixPattern)){
			link = link.replace(settings.servicePrefixPattern, "");
			oV.attr("action", link);
		}
		
		
	});
}

