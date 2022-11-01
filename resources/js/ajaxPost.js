$( function (){

    $('.PlayerCheckBox').on('change', function(){

            // let form = $('#form')  //これだと常に最初のformを指定してしまう
            let form = $(this.form);  //クリックしたcheckboxを含むformをjqueryで取得
        
        $.ajax({
            headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },

            url     :   form.attr('action'),
            type    :   form.attr('method'),
            data    :   form.serialize(),
        })

        //通信が成功した時
        .done((res)=>{
            // console.log(res)
            console.log('成功')
        })
        //通信が失敗したとき
        .fail((error)=>{
            // console.log(error.statusText)
            console.log('失敗')
        })
    })
});



