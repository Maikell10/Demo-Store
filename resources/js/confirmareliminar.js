const confirmareliminar = new Vue({
    el: "#confirmareliminar",
    data: {
        urlaeliminar: ""
    },
    methods: {
        deseas_eliminar(id) {
            this.urlaeliminar =
                document.getElementById("urlbase").innerHTML + "/" + id;
            $('#modal_eliminar').modal('show');
        },
        deseas_eliminar_provider(id) {
            this.urlaeliminar =
                document.getElementById("urlbase").innerHTML + "/" + id;
        },
        deseas_eliminar_purchase(id) {
            this.urlaeliminar =
                document.getElementById("urlbase").innerHTML + "/" + id;
        },
        deseas_eliminar_purchase_detail(id) {
            this.urlaeliminar =
                //document.getElementById("urlbase").innerHTML + "/" + id;
                'http://tiendademo1.test/admin/purchaseDetail/destroy' + '/' + id;
        },
    },
    mounted(){
        $('#modal_eliminar_provider').on('show.bs.modal', function(e) {
            //get id attribute of the clicked element
            var providerID = $(e.relatedTarget).data('id');
    
            //populate the textbox
            $(e.currentTarget).find('input[name="providerID"]').val(providerID);

            confirmareliminar.deseas_eliminar_provider($('#providerID').val())
        });

        $('#modal_eliminar_purchase').on('show.bs.modal', function(e) {
            //get id attribute of the clicked element
            var purchaseID = $(e.relatedTarget).data('id');
    
            //populate the textbox
            $(e.currentTarget).find('input[name="purchaseID"]').val(purchaseID);

            confirmareliminar.deseas_eliminar_purchase($('#purchaseID').val())
        });

        $('#modal_eliminar_purchase_detail').on('show.bs.modal', function(e) {
            //get id attribute of the clicked element
            var purchaseDetailID = $(e.relatedTarget).data('id');
    
            //populate the textbox
            $(e.currentTarget).find('input[name="purchaseDetailID"]').val(purchaseDetailID);

            confirmareliminar.deseas_eliminar_purchase_detail($('#purchaseDetailID').val())
        });
    }
});
