<form action="" method="post">
    <select id="select1" class="select1" name="select1"> <!--Supplement an id here instead of using 'name'-->
        <option value="1">Значение 1</option>
        <option value="1">Значение 2</option>
        <option value="1">Значение 3</option>
    </select>
    <select name="select2"> <!--Supplement an id here instead of using 'name'-->
        <option value="1">Значение 1</option>
        <option value="1">Значение 2</option>
        <option value="1">Значение 3</option>
    </select>
</form>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>-->
<!--<script  >-->
<!--    $("document").ready(function () {-->
<!--        let select = document.getElementById("select1");-->
<!--        select.addEventListener("change", () => {-->
<!--            $.ajax({-->
<!--                url: "/fetch/car_brand.php",-->
<!--                method: "post",-->
<!--                dataType: "html",-->
<!--                data: {"id": select.value},-->
<!--                success: function (data) {-->
<!--                    // let car_models = data;-->
<!--                    console.log(data);-->
<!--                }-->
<!--            });-->
<!--        })-->
<!--    });-->
<!--</script>-->
