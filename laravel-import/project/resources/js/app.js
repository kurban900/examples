require('./bootstrap');

let result = document.getElementById('import_status')

window.Echo.channel('importing')
    .listen('.file.uploaded', function () {
        result.innerHTML = "Файл загружен"
    })
    .listen('.import.part_completed', function (e) {
        result.innerHTML = `Импортировано: ${e.totalImportedRows} строк`
    })

    .listen('.import.completed', function () {
        result.innerHTML = "Импорт завершен <a href='/data'>Открыть</a>"
    });


