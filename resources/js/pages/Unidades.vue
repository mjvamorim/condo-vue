<template>
    <div>
        <v-app-bar dark text color="grey-lighten" dense>
            <v-toolbar dense>Unidades</v-toolbar>
            <v-divider class="mx-2" inset vertical></v-divider>
            <v-spacer></v-spacer>
            <v-dialog v-model="dialog" max-width="700px">
                <template v-slot:activator="{ on }">
                    <v-icon v-on="on">mdi-plus</v-icon>
                </template>
                <v-card>
                    <v-card-title>
                        <span class="headline">{{ formTitle }}</span>
                    </v-card-title>

                    <v-card-text>
                        <v-container grid-list-md>
                            <v-layout wrap>
                                <v-flex xs12>
                                    <v-text-field
                                        v-model="editedItem.descricao"
                                        label="Descrição"
                                        :rules="[rules.required]"
                                    ></v-text-field>
                                </v-flex>
                                <v-flex xs12>
                                    <v-text-field
                                        v-model="editedItem.adicional"
                                        label="Adicional"
                                        v-mask="[
                                            '####.###'
                                        ]"
                                    ></v-text-field>
                                </v-flex>
                                <v-flex xs12>
                                    <v-radio-group v-model="editedItem.tipo_adicional" label="Tipo Adicional" row :mandatory="true">
                                        <v-radio label="Valor Fixo" value="Valor Fixo"></v-radio>
                                        <v-radio label="Percentual" value="Percentual"></v-radio>
                                </v-radio-group>
                                </v-flex>
                                <v-flex xs12>
                                    <v-select
                                        v-model="editedItem.proprietario_id"
                                        :items="allProprietarios"
                                        label="Proprietários"
                                        item-text="nome"
                                        item-value="id"
                                        return-value
                                        :rules="[rules.required]"
                                    ></v-select>
                                </v-flex>
                                <v-flex xs12>
                                    <v-textarea
                                        v-model="editedItem.obs"
                                        label="Obs"
                                    ></v-textarea>
                                </v-flex>
                               <v-flex xs12>
                                    <v-radio-group v-model="editedItem.envio_boleto" label="Envio Boleto" row :mandatory="true">
                                        <v-radio label="Impresso" value="Impresso"></v-radio>
                                        <v-radio label="Ambos" value="Ambos"></v-radio>
                                        <v-radio label="Email" value="Email"></v-radio>
                                </v-radio-group>
                                </v-flex>
                            </v-layout>
                        </v-container>
                    </v-card-text>

                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="blue darken-1" text @click="close"
                            >Cancel</v-btn
                        >
                        <v-btn color="blue darken-1" text @click="save"
                            >Save</v-btn
                        >
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </v-app-bar>
        <v-data-table :headers="headers" :items="tableData" class="elevation-1">

            <template v-slot:item.action="{ item }">
                <v-icon small class="mr-2" @click="editItem(item)">
                    edit
                </v-icon>
                <v-icon small @click="deleteItem(item)">
                    delete
                </v-icon>
            </template>
        </v-data-table>
    </div>
</template>

<script>
export default {
    data: () => ({
        cep: "",
        endereco: {},
        naoLocalizado: false,
        dialog: false,
        headers: [
            { text: "Id", value: "id" },
            { text: "Descrição", value: "descricao" },
            { text: "Tipo Adicional", value: "tipo_adicional" },
            { text: "Adicional", value: "adicional" },
            { text: "Proprietários", value: "proprietario_id" },
            { text: "Actions", value: "action", sortable: false }
        ],
        tableData: [],
        editedIndex: -1,
        allProprietarios: [],
        editedItem: {
            descricao: "",
            adicional: "",
            tipo_adicional: "",
            proprietario_id: "",
            obs: "",
            envio_boleto: "",
            created_at: ""
        },
        defaultItem: {
            descricao: "",
            adicional: "0",
            tipo_adicional: "Valor Fixo",
            proprietario_id: "",
            obs: "",
            envio_boleto: "Impresso",
            created_at: ""        },
        rules: {
            required: value => !!value || "*Obrigatório"
        }
    }),

    computed: {
        formTitle() {
            return this.editedIndex === -1 ? "New Item" : "Edit Item";
        },
        proprietarioNome(id){
            return this.allProprietarios.find(x => x.id = id).nome;
        }
    },

    watch: {
        dialog(val) {
            val || this.close();
        }
    },

    created() {
        this.initialize();
    },

    methods: {
        initialize() {
            axios.get("/api/unidades").then(response => {
                this.tableData = response.data.data;
            });

            axios
                .get("/api/proprietarios")
                .then(response => (this.allProprietarios = response.data.data));
        },

        editItem(item) {
            this.editedIndex = this.tableData.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialog = true;
        },

        deleteItem(item) {
            const index = this.tableData.indexOf(item);
            confirm("Você deseja apagar este item?") &&
                this.tableData.splice(index, 1);

            axios
                .delete("/api/unidades/" + item.id)
                .then(response => console.log(response.data));
        },

        close() {
            this.dialog = false;
            setTimeout(() => {
                this.editedItem = Object.assign({}, this.defaultItem);
                this.editedIndex = -1;
            }, 300);
        },

        save() {
            if (this.editedIndex > -1) {
                Object.assign(
                    this.tableData[this.editedIndex],
                    this.editedItem
                );

                axios
                    .put(
                        "/api/unidades/" + this.editedItem.id,
                        this.editedItem
                    )
                    .then(response => console.log(response.data));
            } else {
                this.tableData.push(this.editedItem);

                axios
                    .post("/api/unidades/", this.editedItem)
                    .then(response => console.log(response.data));
            }
            this.close();
        }
    }
};




</script>
