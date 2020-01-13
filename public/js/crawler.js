function executeAjax(h, f, d, q) //use ajax to send the values required for a ticket to newticket.php
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

//h : the data obtained from crawling the dance page
//f : the data obtained from crawling the food page
//d : the data obtained from crawling the dance page
//q : I use a get request to obtain data from crawler.php and posts this to search.php
//(So yeah, I am turning a get request into a post request... Hope to find another way)