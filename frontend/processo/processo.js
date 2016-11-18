(function(HTTP, Form, Input, Params) {

	HTTP.ajaxSetup({
		contentType: "application/json; charset=utf-8"
	});

	HTTP.get("/backend/services/processo/" + (Params[1] || 0), function(processo) {

		Input('processo_numero').val(processo.numero);
		Input('processo_nome_cliente').val(processo.nomeCliente);

	}, "json");

	Form('frmProcesso', function(formInputJSONData) {

		HTTP.post("/backend/services/processo/" + (Params[1] || 0), formInputJSONData, function(processo) {

				Input('processo_numero').val(processo.numero);
				Input('processo_nome_cliente').val(processo.nomeCliente);

			}, "json")
			.fail(function(XHR) {
				console.error(XHR.responseJSON);
			});

	});

})(jQuery, function(name, OnSubmit) {

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