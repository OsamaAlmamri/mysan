<!-- jQuery UI -->
<script type="text/javascript" src="//code.jquery.com/ui/1.12.1/jquery-ui.js" ></script>

<script type="text/javascript">
    $(function () {
        $('.dataTable > tbody').sortable({
            items: "tr",
            cursor: 'move',
            opacity: 0.6,
            update: function () {
                sendOrderToServer();
            }
        });
        function sendOrderToServer() {
            var order = [];
            $('tr.row1').each(function (index, element) {
                order.push({
                    id: $(this).attr('data-id'),
                    position: index + 1
                });
            });
            console.log(order);
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{route($controler )}}",
                data: {
                    order: order,
                    _token: '{{csrf_token()}}'
                },
                success: function (response) {
                    if (response.status == "success") {
                        console.log(response);
                    } else {
                        console.log(response);
                    }
                },
                error: function (xhr, status, error) {
                    // alert(xhr.responseText);
                }
            });

        }
    });

</script>
