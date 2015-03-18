var brandFilter =
{
    initialize: function(config)
    {
        this.inputSelector = config.inputSelector
        this.refreshFilters()
        this.bindEvent()
        this.bindRemove()
    },

    refreshFilters: function()
    {
        this.filter = ( $(this.inputSelector).val() );
    },

    bindEvent: function()
    {
        $(this.inputSelector).on('keyup', this.filterAll.bind(this))
    },

    filterAll: function ()
    {
        this.refreshFilters()
        this.reset()

        if(this.filter.length > 1)
        {
            $('.search-large.filter .remove').show()
            $('.brand-list li').each( this.filterByString.bind(this) )
            $('.row:not(.search-holder)').each( function(index, element){
                var descendants = $(element).find('.brand-list li')
                var hasActiveChildren = false
                $(descendants).each(function(index, li){
                    if($(li).is(":visible"))
                    {
                        hasActiveChildren = true;
                    }
                })
                if(!hasActiveChildren)
                {
                    $(element).hide();
                    if($(element).find('.letter'))
                    {
                        $(element).find('.letter').hide()
                    }
                }
            })

        } else {
            $('.search-large.filter .remove').hide()
        }
    },

    filterByString: function(index, element)
    {
        if( !($(element).text().trim().toLowerCase().indexOf(this.filter.toLowerCase()) > -1) )
        {
            $(element).hide();
        }
    },

    reset: function()
    {
        $('.row:not(.search-holder)').each( function(index, element){
            $(element).show()
            $(element).find('.letter').show()
        })
        $('.brand-list li').each( function(index, element){
            $(element).show();
        })
    },

    bindRemove: function()
    {
        var element = $('.search-large.filter .remove')
        $(element).on('click', this.removeFilter.bind(this))
    },

    removeFilter: function(event)
    {
        event.preventDefault()
        $(this.inputSelector).setValue('')
        this.filterAll()
    }

}