const api_direct_m = new Vue({
    el: "#api_direct_m",
    data: {
        user_id: $('#user_id_dm').val(),
        store_user_id: $('#store_user_id_dm').val(),
        order_id: $('#order_id_dm').val(),
        type_dm: $('#type_dm').val(),
        date_order: $('#date_order').val(),
        direct_m: '',
    },
    methods: {
        setDirectM() {
            if (this.user_id != '') {
                axios
                .get("http://tiendademo1.test/direct_message/new", {
                    params: { order_id: this.order_id, user_id: this.user_id, store_user_id: this.store_user_id, direct_m:this.direct_m, type_dm:this.type_dm, date_order:this.date_order }
                })
                .then(response => {
                    if (response.data == 'positivo') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Mensaje Enviado!',
                            showConfirmButton: false,
                            timer: 1200
                        })
                        window.setTimeout(function(){
                            location.reload();
                        }, 1200)
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Fallo al Enviar!',
                            showConfirmButton: false,
                            timer: 1200
                        })
                    }
                }).catch(err => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Fallo al Enviar!',
                        showConfirmButton: false,
                        timer: 1200
                    })
                })
            }
        },
    },
    mounted() {
        document.getElementById('direct-chat-messages').scrollTop=document.getElementById('direct-chat-messages').scrollHeight
    }
});