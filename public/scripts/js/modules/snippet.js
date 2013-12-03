(function () {

    // create our snippet model
    App.Models.Snippet = Backbone.Model.extend({});

   // create our view for a snippet
    App.Views.Snippet = Backbone.View.extend({
        tagName: 'div',

        template: App.Util.loadTmpl('Snippet'),

        initialize: function () {
            this.listenTo(this.model, 'change', this.render);
        },

        render: function () {
            this.$el.addClass('snippet');
            this.$el.html( this.template( this.model.toJSON() ) );
            return this;
        }
    });

    // create our snippet collection
    App.Collections.Snippets = Backbone.Collection.extend({
        model: App.Models.Snippet
    });

    // create our snippet views collection
    App.Views.Snippets = Backbone.View.extend({
        tagName: 'div',

        initialize: function () {
            var self = this;
            this._views = [];

            this.collection.each(function (snippet) {

                self._views.push( new App.Views.Snippet({
                    model: snippet
                }));
            })

            this.listenTo(this.collection, 'add', this.addSnippet);
        },

        render: function () {
            var self = this,
                  frag = document.createDocumentFragment();

            this.$el.empty();

            _.each( this._views, function (view) {

                frag.appendChild( view.render().el );
            });

            this.$el.append( frag );

            return this;
        },

        addSnippet: function (snippet) {
            
            var snippetView = new App.Views.Snippet({ model: snippet });
            this.$el.append( snippetView.render().el );
        }
    });
}());