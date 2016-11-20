(function(HTTP, Form, Input, Params) {

	HTTP.get("/backend/services/processo/" + (Params[1] || 0), function(processo) {

		Input('processo_numero').val(processo.numero);
		Input('processo_nome_cliente').val(processo.nomeCliente);

	});

	Form('frmProcesso', function(formInputJSONData) {

		HTTP.put("/backend/services/processo/" + (Params[1] || 0), formInputJSONData, function(_message) {

			console.log(_message);

		}, function(_error) {

			console.error(_error);
		});

	});

})({
	ajax: function(_method, _resource, _data, _callback, _fail) {

		$.ajaxSetup({
			contentType: "application/json; charset=utf-8"
		});

		if ($.isFunction(_data)) {
			_fail = _callback;
			_callback = _data;
			_data = {};
		}

		return $.ajax({
			url: _resource,
			method: _method,
			success: function(data, textStatus, jqXHR) {
				_callback.call({}, data);
			},
			error: function(jqXHR, textStatus, errorThrown) {
				_fail.call({}, errorThrown);
			},
			statusCode: {
				404: function() {
					alert("page not found");
				}
			},
			data: _data,
			dataType: 'json',
			contentType: "application/json; charset=utf-8"
		});
	},
	get: function(resource, data, callback, fail) {
		this.ajax('GET', resource, data, callback, fail);
	},
	put: function(resource, data, callback, fail) {
		this.ajax('PUT', resource, data, callback, fail);
	},
	post: function(resource, data, callback, fail) {
		this.ajax('POST', resource, data, callback, fail);
	},
	delete: function(resource, data, callback, fail) {
		this.ajax('DELETE', resource, data, callback, fail);
	}

}, function(name, OnSubmit) {

	return $('form[name=' + name + ']').submit(function(event) {
		event.preventDefault();

		var myArray = $(this).serializeArray();
		var data = {};

		for (var obj of myArray) {
			data[obj.name] = obj.value;
		}

		OnSubmit.call({
			Event: event
		}, JSON.stringify(data));
	});

}, function(name) {

	return $('input[name=' + name + ']');

}, (function() {
	return window.location.pathname.slice(1).split('/');
})());