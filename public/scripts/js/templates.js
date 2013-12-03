window.loadTmpl = (function () {

    var templates = {}, tempHtml, buildObj, getTemplate;

    $.get('templates/templates.html', function(html) {
        buildObj( html );
    });

    buildObj = function (html) {
        var temps = $( html ).children('script');
        $.each( temps, function (index, template) {
            templates[template.id] = template.innerHTML.trim();
        });
    };

    getTemplate = function (temp) {
        return ( temp in templates ) ? templates[temp] : null;
    };

    return getTemplate;
}());