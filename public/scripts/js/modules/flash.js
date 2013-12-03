(function () {
    App.Views.Flash = Backbone.View.extend({
        el: '#flash-container',

        events: {
            'click button.close' : 'closeFlashMessage'
        },

        initialize: function () {
            var self = this;

            this.$el.hide();
            this.error = this.$el.find('div.alert-danger').hide();
            this.warning = this.$el.find('div.alert-warning').hide();
            this.info = this.$el.find('div.alert-info').hide();
            this.success = this.$el.find('div.alert-success').hide();

            App.Util.Events.on('flash:show', function (flashMessage) {
                self.showFlashMessage(flashMessage);
            });

            App.Util.Events.on('flash:clear', function (flash) {
                self.clearFlashMessage(flash);
            });
        },

        showFlashMessage: function(flashMessage) {

            this[flashMessage.type]
                .show()
                .children('span')
                .text(flashMessage.message);
            this.$el.show();
        },

        clearFlashMessage: function(flash) {

            this[flash.type]
                .hide()
                .children('span')
                .text('');
            this.$el.hide();
        },

        closeFlashMessage: function (e) {

            $( e.currentTarget )
                .parent()
                .hide()
                .children('span')
                .text('');

            e.preventDefault();
        }
    });

    new App.Views.Flash();
}());
