const appTienda = new Vue({
    el: "#appTienda",
    data: {
        nombre_producto: "",

        cantidadCart: $("#numId").val(),
        cantTotal: 0,

        id_producto: "",
        precio_act: [],
        precio_total: 0,

        lang: $("#lang").val(),

        user_id: $('#user_id_dm').val(),
        store_user_id: $('#store_user_id_dm').val(),
        order_id: $('#order_id_dm').val(),
        type_dm: $('#type_dm').val(),
        date_order: $('#date_order').val(),
        direct_m: '',
    },
    methods: {
        cambioCant(a) {
            this.id_producto = $("#id_producto"+a).val()
            this.precio_act[a] = this.format($("#precio_act"+a).val()*$('#cantidad'+a).val())

            var cantT = 0
            this.cantTotal = 0
            this.precio_total = 0
            for (let i = 0; i < this.cantidadCart; i++) {
                cantT = $("#cantidad"+i).val()
                this.cantTotal = parseInt(cantT) + this.cantTotal
                var precio_act_sf = $("#precio_act"+i).val()*$('#cantidad'+i).val()
                this.precio_total = (this.precio_total) + (precio_act_sf)
            }

            this.precio_total = this.format(this.precio_total)

            axios
                .get("https://tuminimercado.com/store/cart/adde/"+this.id_producto, {
                    params: { cantidad: $('#cantidad'+a).val() }
                })
                .then(response => {
                    this.id_producto = response.data;
                    location.reload();
                });
        },

        eliminarCarrito(id,product_id) {
            $.ajax({
                type: "POST",
                data: $('#formDelete').serialize(),
                url: "/store/cart/" + id + "?product_id=" + product_id,
                success: function(response) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Eliminado con éxito!',
                        showConfirmButton: false,
                    })
                    
                    window.setTimeout(function(){
                        location.reload();
                    }, 500)
                }
            });
        },

        order() {
            if (this.lang == 'es') {
                Swal.fire({
                    title: "Estas seguro de proceder con la compra?",
                    text: "¡No podrás revertir esto!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sí!",
                    cancelButtonText: "Cancelar"
                }).then(result => {
                    if (result.value) {
                        location.replace('https://tuminimercado.com/store/purchases?gpont_=gheyudjiqnnsdk15_?daj_DfsR');
                    } else {
                        Swal.fire(
                            "Cancelado!",
                            "Cancelado!",
                            "error"
                        );
                    }
                });
            } else {
                Swal.fire({
                    title: "Are you sure to proceed with the purchase?",
                    text: "You will not be able to reverse this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes!",
                    cancelButtonText: "Cancel"
                }).then(result => {
                    if (result.value) {
                        location.replace('https://tuminimercado.com/store/purchases?gpont_=gheyudjiqnnsdk15_?daj_DfsR');
                    } else {
                        Swal.fire(
                            "Canceled!",
                            "Canceled!",
                            "error"
                        );
                    }
                });
            }
        },

        format(num) {
            if (!num || num == 'NaN') return '-';
            if (num == 'Infinity') return '&#x221e;';
            num = num.toString().replace(/\$|\,/g, '');
            if (isNaN(num))
                num = "0";
            var sign = (num == (num = Math.abs(num)));
            num = Math.floor(num * 100 + 0.50000000001);
            var cents = num % 100;
            num = Math.floor(num / 100).toString();
            if (cents < 10)
                cents = "0" + cents;
            for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3) ; i++)
                num = num.substring(0, num.length - (4 * i + 3)) + ',' + num.substring(num.length - (4 * i + 3));
            return (((sign) ? '' : '-') + num + '.' + cents);
        },
        setDirectM(a) {
            var store_user_id=document.forms["form"+a].elements[2].value;
            if (this.user_id != '') {
                axios
                .get("https://tuminimercado.com/direct_message/new", {
                    params: { order_id: this.order_id, user_id: this.user_id, store_user_id: store_user_id, direct_m:this.direct_m, type_dm:this.type_dm, date_order:this.date_order }
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
        this.cantidadCart = $("#numId").val()

        var cantT = this.cantidadCart;
        for (let i = 0; i < this.cantidadCart; i++) {
            cantT = $("#cantidad"+i).val()
            this.cantTotal = parseInt(cantT) + this.cantTotal
        }

        for (let i = 0; i < this.cantidadCart; i++) {
            this.precio_total = this.precio_total + ($("#precio_act"+i).val()*$('#cantidad'+i).val())
            this.precio_act[i] = this.format($("#precio_act"+i).val()*$('#cantidad'+i).val())
            
            $('#cantidad'+i).select2().on('change', async function() {
                await appTienda.cambioCant(i)
            });
        };
        this.precio_total = this.format(this.precio_total)

        if ($("#final").length > 0) {
            document.getElementById('final').scrollIntoView(true);
            document.getElementById('inicio').scrollIntoView(true);
        }
        
    }
});