<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Vehicles</div>
                    <div class="card-body">
                        <el-button type="success" v-on:click="addVehicle()">Add Vehicle</el-button>
                    </div>
                    <div class="card-body">
                        <el-table
                            :data="tableData"
                            style="width: 100%">
                            <el-table-column
                                prop="make"
                                label="Make"
                                width="180">
                            </el-table-column>
                            <el-table-column
                                prop="model"
                                label="Model"
                                width="180">
                            </el-table-column>
                            <el-table-column
                                prop="color"
                                label="Color"
                                width="180">
                            </el-table-column>
                            <el-table-column
                                prop="year"
                                label="Year"
                                width="180">
                            </el-table-column>
                            <!-- <el-table-column
                                label="Operations">
                                <template slot-scope="scope">
                                    <el-button
                                        size="mini"
                                        @click="handleEdit(scope.$index, scope.row)">Edit</el-button>
                                    <el-button
                                        size="mini"
                                        type="danger"
                                        @click="handleDelete(scope.$index, scope.row)">Delete</el-button>
                                </template>
                            </el-table-column> -->
                        </el-table>
                    </div>
                </div>
            </div>
        </div>
        <el-dialog
            close-on-click-modal="false"
            title="Add Vehicle"
            :visible.sync="showDialog"
            width="30%">
                <el-form :model="form">
                    <el-form-item label="Make">
                        <el-input v-model="form.make" placeholder=""></el-input>
                    </el-form-item>
                    <el-form-item label="Model">
                        <el-input v-model="form.model" placeholder=""></el-input>
                    </el-form-item>
                    <el-form-item label="Color">
                        <el-input v-model="form.color" placeholder=""></el-input>
                    </el-form-item>
                    <el-form-item label="Year">
                        <el-input v-model="form.year" placeholder=""></el-input>
                    </el-form-item>
                </el-form>
                <span slot="footer" class="dialog-footer">
                    <el-button @click="showDialog = false">Cancel</el-button>
                    <el-button type="primary" @click="sendVehicle()">Confirm</el-button>
                </span>
        </el-dialog>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.getVehicles()
        },
        data() {
            return {
                tableData: null,
                showDialog: false,
                form: {
                    make:  null,
                    model: null,
                    color: null,
                    year:  null,
                },
            }
        },
        methods: {
            addVehicle() {
                this.showDialog = true
            },
            sendVehicle() {
                let self = this
                this.showDialog = false

                axios.post('/api/vehicles', {
                    make:  this.form.make,
                    model: this.form.model,
                    color: this.form.color,
                    year:  this.form.year,
                })
                .then(function (response) {
                    console.log(response)
                })
                .catch(function (error){
                    console.log(error)
                })
                .then(function () {
                    self.clearFormData()
                    self.getVehicles()
                })
            },
            getVehicles() {
                let self = this
                axios.get('/api/vehicles')
                    .then(function (response) {
                        self.tableData = response.data.data
                    })
                    .catch(function (error){
                        console.log(error)
                    })
            },
            clearFormData() {
                this.form.make  = null
                this.form.model = null
                this.form.color = null
                this.form.year  = null
            }
        }
    }
</script>
