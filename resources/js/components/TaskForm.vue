<template>
    <div class="row">
        <div class="col-8">
            <h3 class="d-inline-block">Tasks</h3><a
            :href="'/tasks/create'+(this.projectId != null?'?project_id='+this.projectId:'')"
            class="btn btn-success d-inline-block float-end">Create
            Task</a>

            <table class="table table-striped">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Name</th>
                    <th scope="col">Project Name</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Updated At</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <draggable v-if="myTasks.length != 0" v-model="myTasks" tag="tbody" @change="updatePriority">
                    <tr v-for="(item,index) in myTasks" :key="index">
                        <td scope="row">{{ index + 1 }}</td>
                        <td>{{ item.name }}</td>
                        <td>{{ item.project.name }}</td>
                        <td>{{ item.created_at }}</td>
                        <td>{{ item.updated_at }}</td>
                        <td><a class="btn btn-primary" :href="updateUrl(item.id)">Update</a>
                            <a class="btn btn-danger" @click.prevent="deleteTask(item.id,index)">Delete</a>
                        </td>
                    </tr>

                </draggable>
                <tr v-else>
                    <td colspan="5" class="text-center mt-2">No data</td>
                </tr>
            </table>
        </div>

    </div>
</template>

<script>
import draggable from 'vuedraggable'

export default {
    components: {
        draggable,
    },
    props: ['tasks'],
    data () {
        return {
            myTasks: this.tasks,
            projectId: '',
        }
    },
    methods: {
        updatePriority () {
            axios.post('/api/tasks/priority', this.myTasks).then(() => {
                alert('updated')
            })
        },
        updateUrl(id)
        {
            return'/tasks/'+id+'/edit'+(this.projectId !=null?'?project_id='+this.projectId:'');
        },
        deleteTask (id, index) {
            this.myTasks.splice(index, 1)
            axios.delete('/tasks/' + id).then(() => {
                alert('deleted successfully')
            })
        },
    },
    created () {
        const queryString = window.location.search
        const urlParams = new URLSearchParams(queryString)
        this.projectId = urlParams.get('project_id')
    },
    name: 'TaskForm',
}
</script>

<style scoped>

</style>
