function afterTableInitialization(settings, json) {
    var table = settings.oInstance.api();
    table.columns().every(function () {
        // any code ...
    });
}
function customSearchAjax(settings, json, form) {
    var table = settings.oInstance.api();
    form.on('submit', function (e) {
        e.preventDefault();
        var formData = $(this).serializeArray();
        table.on('preXhr.dt', function (e, settings, data) {
            Object.values(formData).forEach((item) => {
                data[item.name] = item.value
            })
        }).draw();
    });
}
