const apiProfileUser = new Vue({
    el: "#apiProfileUser",
    data: {
        inputName: $('#inputNameH').val(),
        inputPassword: '',
        inputCheckbox: false
    },
    methods: {
        setCheck() {
            if (this.inputCheckbox == true) {
                $('#btnConfig').prop('disabled', true);
            }
            if (this.inputCheckbox == false) {
                $('#btnConfig').prop('disabled', false);
            }
        },
        updateUser() {
            if (this.inputName.length > 0) {
                Swal.fire({
                    title: "Estas seguro de Editar tus Datos?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sí!",
                    cancelButtonText: "No"
                }).then(result => {
                    if (result.value) {
                        document.getElementById("updateUserForm").submit();
                    } else {
                        Swal.fire(
                            "Cancelado!",
                            "Cancelado!",
                            "error"
                        );
                    }
                })
            }else {
                Swal.fire({
                    icon: 'error',
                    title: 'Fallo al Valorar!',
                    showConfirmButton: false,
                    timer: 1200
                })
            }
        },
    },
    mounted() {
        $("#btnConfig").on("click",function(e){
            e.preventDefault() 
        })

        if (this.inputCheckbox == false) {
            $('#btnConfig').prop('disabled', true);
        }
    }
});