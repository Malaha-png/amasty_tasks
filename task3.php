<!-- PHP файл функций находится в core/fun.php -->
<!-- PHP файл вызова функций находится в core/core.php -->
<!-- Берутся случайные банкноты -->

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>task3</title>
   <style>
      #main {
         display: flex;
         flex-direction: column;
         justify-content: center;
         align-items: center;
      }
   </style>
</head>

<body>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

   <div>

      <a href="./">Назад</a></br>

      <div id="main">
         <center>
            <h1>Банкомат</h1>
         </center>

         <div>
            <div>Купюры в наличии</div>
            <div><input type="number" id="banknote" disabled placeholder="5,10,20,50,100"></div>
         </div>

         <div>
            <p>Введите сумму</p>
            <p><input type="number" id="summ" placeholder="сумма"></p>
            <p id="error"></p>
            <button id="getMoney">Получить</button>
         </div>

         <div>
            <p>Результат</p>
            <p id="rez"></p>
         </div>

      </div>

   </div>



   <script>
      let banknote;

      function banknoteRand() {
         $.post('./core/core.php', {
            action: "banknoteRand",

         }, function(data) {
            if (data) {
               data = JSON.parse(data)
               console.log(data)
               $('#banknote').attr('placeholder', data)
               banknote = data;
            } else {
               console.log('reload')
               banknoteRand()
            }
         })
      }

      $(document).ready(function() {

         banknoteRand()

         $('#getMoney').click(function() {
            if (banknote.length > 0) {
               summ = $('#summ').val()
               if (summ > 0) {
                  $('#error').html('')
                  $.post('./core/core.php', {
                     action: "banknoteGet",
                     banknote: banknote,
                     summ: summ,

                  }, function(data) {
                     if (data) {
                        data = JSON.parse(data)
                        console.log(data)
                        if (data.summMin == summ) {
                           let out = ' <table border="-1"> <tr> <th>Номинал</th> <th>Кол-во</th>'
                           let banknoteGet = data.banknoteGet
                           for (let i in banknoteGet) {
                              let a = banknoteGet[i]
                              out += `<tr> <th>${a[1]}</th> <th>${a[0]}</th>`
                           }
                           out += '<table>'
                           $('#rez').html(out)
                        } else {
                           let out = ' <p>Нельзя получить введенную сумму</p>'
                           out += `<p>Введите предложенную сумму: ${ data.summMin} или  ${ data.summMax} </p>`
                           $('#rez').html(out)
                        }
                     } else {
                        $('#error').html('Ошибка! Попробуйте еще')
                        console.log('error')
                        console.log(data)
                     }
                  })
               } else {
                  $('#error').html('Введите число')
               }
            } else {
               $('#error').html('Ошибка! Попробуйте еще')
               banknoteRand()
            }

         })

      })
   </script>

</body>

</html>