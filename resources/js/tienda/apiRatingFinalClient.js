const apiratingfinalclient = new Vue({
    el: "#apiratingfinalclient",
    data: {
        part: 1,
        option: 'option1',

        select: '',

        calification: '',
        opinion: '',
        
        selectOption: '',

        user_id: '',
        store_user_id: '',

        type_rating: '',
        created_sale: ''
    },
    created() {
        
    },
    methods: {
        FirstPart() {
            if ($('input:radio[name=radioFirst]:checked').val() == 'option1') {
                this.part = 2
                this.option = '1'
            }
            if ($('input:radio[name=radioFirst]:checked').val() == 'option2') {
                this.part = 3
                this.option = '2'
            }
            if ($('input:radio[name=radioFirst]:checked').val() == 'option3') {
                this.part = 3
                this.option = '3'
                this.selectOption = $('#selectOption').val()
            }
        },
        SecondOption() {
            //this.part = 4
            this.opinion = $('#opinion').val()
            if (this.option == '1') {
                this.calification = $('input:radio[name=radioSecond]:checked').val()
            }
            if (this.option == '2' || this.option == '3') {
                this.calification = $('input:radio[name=radioThrird]:checked').val()
            }
            
            Swal.fire({
                title: "Estas seguro de proceder con la calificación?",
                text: "¡No podrás revertir esto!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí!",
                cancelButtonText: "Cancelar"
            }).then(result => {
                if (result.value) {
                    axios
                    .get("http://tiendademo1.test/store/rating_seller", {
                        params: { option: this.option, user_id: this.user_id, store_user_id: this.store_user_id, selectOption:this.selectOption, calification:this.calification, opinion:this.opinion, type_rating:this.type_rating, created_sale:this.created_sale }
                    })
                    .then(response => {
                        if (response.data == 'positivo') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Calificación Enviada!',
                                showConfirmButton: false,
                                timer: 1200
                            })
                            window.setTimeout(function(){
                                location.assign('http://tiendademo1.test/store/purchases');
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
                } else {
                    Swal.fire(
                        "Cancelado!",
                        "Cancelado!",
                        "error"
                    );
                }
            })
        },
        option1() {
            this.select = 0
        },
        option2() {
            this.select = 0
        },
        option3() {
            this.select = 1
        },
        BackFirst() {
            this.part = 1
            this.select = 0
        },
        BackSecond() {
            this.part = 2
            this.select = 0
        },

        
    },
    mounted() {
        this.store_user_id = $('#store_id').val()
        this.user_id = $('#user_id').val()
        this.type_rating = $('#type_rating').val()
        this.created_sale = $('#created_sale').val()
    }
});