<template>
    <div>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"
            @click="showModal = true">
            New Member
        </button>

        <!-- Modal -->
        <modal-component v-if="showModal">
             <div class="card-primary">
                <div class="card-header">
                    <div class="card-title">
                        Add Member
                    </div>
                </div>
                <form role="form">
                    <div class="card-body">
                        <div class="form-group">
                            <label >Member Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Member Name" v-model="name">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" v-on:click.prevent="createTeam">Add New</button>
            </div>
        </modal-component>
    </div>
</template>

<script>
    import ModalComponent from '../../../components/ModalComponent.vue'

    export default {

        data() {
            return {
               members:[
                   {id:'1',name:'Filan Fisteku',type:'Player',date:'11/12/2018'}
               ]
            }
        },

        methods: {
            createTeam() {
                axios.post('/api/teams', {
                    name: this.name,
                })
                .then(function (response) {
                    console.log(response);
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            showModal() {
                false
            },
        },


        components: {
            ModalComponent
        }
    }

</script>
