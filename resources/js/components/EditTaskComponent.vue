<template>
    <div>

        <!-- Button trigger modal -->


        <!-- Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="nameEdit">Nom de la tâche</label>
                        <textarea name="nameEdit" id="nameEdit" rows="4" class="form-control" v-model="taskToEdit.tache"></textarea>
                        
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="submit" class="btn btn-success" @click="update" data-dismiss="modal">Modifier la tâche</button>
            </div>
            </div>
        </div>
        </div>

    </div>
</template>

<script>
    export default {

        props: ['taskToEdit'],
        
        methods: {
            update() {
                axios.patch('/tasks/edit/' + this.taskToEdit.id, {
                    tache: this.taskToEdit.tache
                })
                .then(response => this.$emit('task-updated', response))
                .catch(error => console.log(error));

            }
        }

    }
</script>