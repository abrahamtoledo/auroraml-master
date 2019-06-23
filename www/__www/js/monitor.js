const 
	// Monitor url path
	MONITOR_URI="/task_monitor",
	
	// Resultados
	RESULT_OK = "OK",
	RESULT_FAIL = "FAIL",
	
	// Acciones
	ACTION_START = "start",
	ACTION_GET_STATE="get_state",
	ACTION_ABORT="abort",
	ACTION_RETRY="retry",
	ACTION_GET_CONTENT_SETTINGS="get_content_settings",
	
	// Estados
	STATE_STARTING = 0,
	STATE_SENDING = 1,
	STATE_SENT = 2,
	STATE_WAITING_RESPONSE = 3,
	STATE_DOWNLOADING_RESPONSE = 4,
	STATE_COMPLETED_RESPONSE = 5,
	STATE_SAVING = 6,
	STATE_COMPLETED = 7,
	STATE_ABORTED = 8,
	STATE_FAILED = 9,
	
	// Keys
	KEY_ACTION="action",
	KEY_URI="uri",
	KEY_THREAD_ID="thread_id",
	KEY_HTTP_METHOD="method",
	KEY_STATE="state",
	KEY_RESULT="result",
	KEY_PROGRESS="progress",
	KEY_SIZE="size",
	KEY_NAME="name",
	KEY_ERROR="error",
	
	// Otras
	UPDATE_TIMEOUT=300,
	METHOD_GET="get",
	METHOD_POST="post"
	;

// Cambiar a false en el release
const DEBUG=true;

/**
 * Envia un mensaje a la consola para debug. 
 * en android esto debe aparecer en logcat.
 * @param {String} message
 */
function debug(message){
	if (DEBUG){
		//console.debug("AuroraSuite_JS: thread-id=" + gThreadId + " ; uri=" + gUri + "  ->" + message);
		console.debug(message);
	}
}

var urlParams =
(window.onpopstate = function () {
    var match,
        pl     = /\+/g,  // Regex for replacing addition symbol with a space
        search = /([^&=]+)=?([^&]*)/g,
        decode = function (s) { return decodeURIComponent(s.replace(pl, " ")); },
        query  = window.location.search.substring(1);

    var urlParams = {};
    while (match = search.exec(query))
       urlParams[decode(match[1])] = decode(match[2]);
	   
	return urlParams;
})();

function ProgressBar(selector){
	var conf = arguments[1] || {};
	
	this.min = conf.min || 0;
	this.max = conf.max || 100;
	
	this.$ = $(selector);
	
	this.$.addClass("progressbar").append(
		$("<div/>").addClass("prog-meter")
	);
	this.progMeter = this.$.find(".prog-meter");
	
	var _this = this;
	
	this.setIndeterminate = function(bIndet){
		if (bIndet){
			_this.progMeter.addClass("ind");
		}else{
			_this.progMeter.removeClass("ind");
		}
	}
	
	this.setProgress = function(val){
		val = Math.floor( (val - this.min) * 100 / (this.max - this.min) );
		_this.progMeter.css({width: val + "%"});
	}
	
	this.setProgress(conf.progress || this.min);
	this.setIndeterminate(conf.indeterminate);// undefined es equiv a false dentro de un if; 
	
	//return this;
}

var pbar;
var gName = null;

var gThreadId = urlParams[KEY_THREAD_ID]
var gUri = urlParams[KEY_URI];
var gMethod = urlParams[KEY_HTTP_METHOD];

$(function(){
	pbar = new ProgressBar("#pbar", {indeterminate: true});
	// setear el titulo y nombre
	$('#title').text("Iniciando");
	$('#name').text(gUri);
	
	$('#cancel-btn').click(function(){
		taskAction(ACTION_ABORT, function(json){});
		debug("Se cancelo la tarea");
	});
	
	$('#retry-btn').click(function(){
		debug("Reintentando");
		taskAction(ACTION_RETRY, function(json){
			if (json[KEY_RESULT] == RESULT_OK){
				debug("Reintentando con la misma solicitud");
				dState = null;
				gName = null;
				setTimeout(updateState, UPDATE_TIMEOUT);
			}else{
				
				if (gMethod.toLowerCase() == METHOD_GET) {
					debug("Reintentando con una nueva solicitud");
					
					// se debe hacer un refresh, para ello es necesario que 
					// queryMobile no manipule el history la pagina
					document.location.replace(gUri);
				}else{
					alert("No se puede reintentar esta solicitud. Debe repitir la operación");
					window.history.back();
				}
			}
		});
	});
	
	$('#back-btn').click(function(){
		debug("Cancelling and going back");
		taskAction(ACTION_ABORT, function(json){});
		setTimeout(function(){window.history.back();}, 300);
	});
	
	startTask();
});

function taskAction(action, callback){
	var params = {};
	params[KEY_ACTION] = action;
	params[KEY_THREAD_ID] = gThreadId;
	$.getJSON(MONITOR_URI, params, callback);
}

function startTask(){
	debug("Iniciando la tarea");
	taskAction(ACTION_START, function(json){
		debug("Tarea iniciada");
		setTimeout(updateState, UPDATE_TIMEOUT);
	});
}

function updateState(){
	debug("Actualizando estado");
	taskAction(ACTION_GET_STATE, function(json){
		
		debug("Estado actual => " + JSON.stringify(json));
		
		switch(json[KEY_STATE]){
			case STATE_STARTING:
				openIndeterminateMonitor("Comenzando", gUri);
				break;
			case STATE_SENDING:
				openIndeterminateMonitor("Enviando", gUri);
				break;
			case STATE_SENT:
				openIndeterminateMonitor("Enviado", gUri);
				break;
			case STATE_WAITING_RESPONSE:
				openIndeterminateMonitor("Esperando", gUri);
				break;
			case STATE_DOWNLOADING_RESPONSE:
				gName = gName || json[KEY_NAME];
				openDetailsMonitor("Recibiendo", json[KEY_PROGRESS], json[KEY_SIZE], json[KEY_NAME]);
				break;
			case STATE_COMPLETED_RESPONSE:
				openIndeterminateMonitor("Recibido", gName);
				break;
			case STATE_COMPLETED:
				openUri(json[KEY_URI]);
				return;
			case STATE_FAILED:
				openErrorMonitor("Error", json[KEY_ERROR]);
				return;
			case STATE_ABORTED:
				openErrorMonitor("Cancelado", "Se cancelo la descarga de la página");
				return;
		}
		
		setTimeout(updateState, UPDATE_TIMEOUT);
	});
}

// INDETERMINATE MONITOR
function openIndeterminateMonitor(title, uri){
	pbar.setIndeterminate(true);
	
	// Esconder los display de informacion
	$('#above-info, #below-info').removeClass('fade in');
	
	// setear el titulo y nombre
	document.title = title;
	$('#title').text(title);
	$('#name').text(uri);
	$.mobile.changePage("#monitor", {changeHash: false});
}

// DETAILS MONITOR
var dState = null;
function openDetailsMonitor(title, progress, size, name){
	
	if (dState != null){
		dState.updateState(new Date(), progress, size);
	}else {
		dState = new DownloadState(new Date(), progress, size);
		// Mostrar la vista 
		$('#above-info, #below-info').addClass('fade in');
	}
	
	pbar.setIndeterminate(false);
	document.title = title;
	$('#title').text(title);
	$('#name').text(name);
	
	var p = scale(dState.progress, 1024, 3);
	var s = scale(dState.size, 1024, 3);
	var percent = dState.progress * 100 / dState.size;
	percent = Math.round(percent * 100) / 100;
	
	var speed = scale(dState.speed, 1024, 3); 
	
	$('#progress').text(p.x + " " + sizeUnit(p.e));
	$('#size').text(s.x + " " + sizeUnit(s.e));
	$('#percent').text(percent + " %");
	$('#speed').text(speed.x + " " + sizeUnit(speed.e) + " / s");
	pbar.setProgress(percent);
	
	var time = dState.getRemainingTime();
	var sec = time % 60;
	var min = Math.round((time - sec) / 60);
	
	$('#rem-time').text(min + ":" + sec);
	
	$.mobile.changePage("#monitor", {changeHash: false});
}

/**
 * max{[y, e]} tal que que x = y * b^e con N cifras significativas
 * O sea lo lleva a notacion cientifica con N cifras significativas
 * @param {Number} x 
 * @param {Number} b 
 * @param {Number} N 
 * @return {Object} {x, e}
 */
function scale(x, b, N){
	if (x == 0)
		return {x: 0, e: 0};
		
	var tpn = Math.pow(10, N);
	var e = 0;
	while(x > tpn - 1){
		e++;
		x = x / b;
	}
	
	// Log base 10. log + 1 es la cantidad de cifras de [x]
	var log = Math.floor(Math.log(x) / Math.LN10);
	log++;
	
	var B = Math.pow(10, N - log);
	x = Math.round(x * B) / B; // Ahora x tiene a lo sumo N cifras significativas
	
	return {x: x, e: e};
}
function sizeUnit(e){
	switch(e){
		case 0:
			return "b";
		case 1:
			return "Kb";
		case 2:
			return "Mb";
		case 3:
			return "Gb";
		default:
			return "Unidad desconocida"
	}
}

/**
 * Mantiene el estado de la descarga en el momento que
 * se esta recibiendo la respuesta
 * @param {Date} date
 * @param {number} progress
 * @param {number} size
 */
function DownloadState(date, progress, size){
	this.time = date.getTime();
	this.progress = progress;
	this.size = size;
	this.speed = 0;
	
	var _this = this;
	
	/**
	 * Actualiza el estado de este objeto
	 * @param {Date} date
	 * @param {number} progress
	 * @param {number} size
	 */
	this.updateState = function(date, progress, size){
		
		// Calcular la velocidad promediada
		var speed = (function(prev, curr){
			var elapsed = curr.time - prev.time;
			var received = curr.progress - prev.progress;
			var fSpeed = received * 1000 / elapsed; 
			fSpeed = isNaN(fSpeed) ? 0 : fSpeed; // Check division by 0, occurs when curr and prev are the same 
			
			return Math.floor(fSpeed);
		})(_this, new DownloadState(date, progress, size));
		
		_this.progress = progress;
		_this.size = size;
		_this.time = date.getTime();
		_this.speed = ( (1/4) * _this.speed ) + ( (3/4) * speed );
	}
	
	/**
	 * Obtiene el tiempo restante en segundos
	 * @return {number}
	 */
	this.getRemainingTime = function(){
		var fTime = (_this.size - _this.progress) / _this.speed;
		fTime = isNaN(fTime) ? Number.MAX_VALUE : fTime;
		return Math.ceil(fTime); 
	}
	
}

// ERROR MONITOR

function openErrorMonitor(title, error){
	document.title = title;
	$("#title").text(title);
	$("#error").text(error);
	$.mobile.changePage("#error-page", {changeHash: false});
}

function openUri(uri){
	debug("Abriendo: " + uri);
	document.location.replace(uri);
}
