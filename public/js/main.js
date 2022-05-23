function Alert(message){
    $.confirm({
        title: '<i class="fas fa-bell"></i> Thông Báo',
        content: message,
        type: 'purple',
        buttons:{
            cancelAction:{
                text: 'Đóng',
                btnClass: 'btn-blue'
            }
        }
    });
}

function Alerts(message){
    $.confirm({
        title: '<i class="fas fa-bell"></i> Thông Báo',
        content: message,
        type: 'purple',
        autoClose: 'cancelAction|5000',
        buttons:{
            cancelAction:{
                text: 'Đóng',
                btnClass: 'btn-blue'
            }
        }
    });
}

function Error(message){
    $.confirm({
        title: '<i class="fas fa-exclamation-triangle"></i> Thông Báo',
        content: message,
        type: 'red',
        buttons:{
            cancelAction:{
                text: 'Đóng',
                btnClass: 'btn-blue'
            }
        }
    });
}

function Errors(message){
    $.confirm({
        title: '<i class="fas fa-exclamation-triangle"></i> Thông Báo',
        content: message,
        type: 'red',
        autoClose: 'cancelAction|5000',
        buttons:{
            cancelAction:{
                text: 'Đóng',
                btnClass: 'btn-blue'
            }
        }
    });
}

function checkLength(str, length){
    if(str.length < length)
        return false;

    return true;
}

function my_compare(key1, key2){
    if(key1 !== key2)
        return false;

    return true;
}