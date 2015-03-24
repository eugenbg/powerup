BaseClass = function (){}

BaseClass.prototype.update = function(data)
{
    if(data.status = 'success')
    {
        var updated = [];
        for (id in data)
        {
            if(id != 'status')
            {
                $(this.map[id]).replaceWith(data[id]);
                updated.push(id);
            }
        }
        return updated;
    }
}

BaseClass.prototype.greet = function()
{
    console.log('hello')
}