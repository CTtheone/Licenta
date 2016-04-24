/*
     Script
 */
 var value_to_search = "";
 
function get_search_item() {
    var item = document.getElementById('search').value;
    value_to_search = item;
    var link = document.getElementById('search-link');
    link.setAttribute("href", "index.php?search=" + item);
}


function searchKeyPress(e)
{
    // look for window.event in case event isn't passed in
    e = e || window.event;
    if (e.keyCode == 13)
    {
        document.getElementById('searchButton').click();
        return false;
    }
    return true;
}