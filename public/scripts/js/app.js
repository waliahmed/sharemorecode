window.App = {
    Models : {},
    Views: {},
    Collections: {},
    Util: {}
};

App.Util.loadTmpl = (function () {

    var templates = {}, tempHtml, buildObj, getTemplate, loaded = false;

    buildObj = function (html) {
        var temps = $( html ).children('script');
        $.each(temps, function (index, template) {
            templates[template.id] = _.template( template.innerHTML.trim() );
        });
        loaded = true;
    };

    getTemplate = function (temp) {
        return ( temp in templates ) ? templates[temp] : null;
    };

    $.ajax({
        method: 'GET',
        url: 'templates/templates.html',
        async: false
    })
    .done(function (html) {

        buildObj(html);
    }).error(function (err) {

        console.warn( "Failed to load Backbone Templates :: " + err.message );
    });

    return getTemplate;
}());

App.Util.Events = _.extend({}, Backbone.Events);
