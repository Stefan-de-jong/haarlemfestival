function executeAjax(h, f, d, q) //use AJAX to send the values required for the search method to search.php
{
    $(document).ready(function(){

              $.ajax({
                type: 'POST',
                url: 'pages/search',
                data: {historic:h, food:f, dance:d, query:q},
                success: function(response) {
                    $('body').append(response);
                    
                }
            });
});
}

//h : the data obtained from crawling the historic page
//f : the data obtained from crawling the food page
//d : the data obtained from crawling the dance page
//q : use a GET request to obtain data from crawler.php and POST this to search.php