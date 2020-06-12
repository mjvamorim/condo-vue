<template>
    <div>
        <v-app-bar dark text color="grey-lighten" dense>
            <v-toolbar dense>Proprietarios</v-toolbar>
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
                                        v-model="editedItem.nome"
                                        label="Nome"
                                        :rules="[rules.required]"
                                    ></v-text-field>
                                </v-flex>
                                <v-flex xs12>
                                    <v-text-field
                                        v-model="editedItem.email"
                                        label="Email"
                                        :rules="[rules.email]"
                                    ></v-text-field>
                                </v-flex>

                                <v-flex xs12>
                                    <v-text-field
                                        v-model="editedItem.celular"
                                        label="Celular"
                                        v-mask="[
                                            '(##)####-####',
                                            '(##)#####-####'
                                        ]"
                                    ></v-text-field>
                                </v-flex>

                                <v-flex xs12>
                                    <v-text-field
                                        v-model="editedItem.fixo"
                                        label="Telefone Fixo"
                                        v-mask="[
                                            '(##)####-####',
                                            '(##)#####-####'
                                        ]"
                                    ></v-text-field>
                                </v-flex>

                                <v-flex xs12>
                                    <v-text-field
                                        v-model="editedItem.cpf"
                                        label="CPF/CNPJ"
                                        :rules="[rules.required]"
                                        v-mask="[
                                            '###.###.###-##',
                                            '##.###.###/####-##'
                                        ]"
                                    ></v-text-field>
                                </v-flex>

                                <v-flex xs12>
                                    <v-text-field
                                        v-model="editedItem.cep"
                                        label="Cep"
                                        :rules="[rules.required]"
                                        v-mask="['#####-###']"
                                        @blur="buscar_cep"
                                    ></v-text-field>
                                </v-flex>

                                <v-flex xs12>
                                    <v-text-field
                                        v-model="editedItem.rua"
                                        label="Rua"
                                        :rules="[rules.required]"
                                    ></v-text-field>
                                </v-flex>

                                <v-flex xs12>
                                    <v-text-field
                                        v-model="editedItem.numero"
                                        label="Número"
                                    ></v-text-field>
                                </v-flex>

                                <v-flex xs12>
                                    <v-text-field
                                        v-model="editedItem.complemento"
                                        label="Complemento"
                                    ></v-text-field>
                                </v-flex>

                                <v-flex xs12>
                                    <v-text-field
                                        v-model="editedItem.bairro"
                                        label="Bairro"
                                        :rules="[rules.required]"
                                    ></v-text-field>
                                </v-flex>

                                <v-flex xs12>
                                    <v-text-field
                                        v-model="editedItem.cidade"
                                        label="Cidade"
                                        :rules="[rules.required]"
                                    ></v-text-field>
                                </v-flex>

                                <v-flex xs12>
                                    <v-select
                                        v-model="editedItem.uf"
                                        :items="allEstados"
                                        label="Estados"
                                        item-text="uf"
                                        return-values
                                        :rules="[rules.required]"
                                    ></v-select>
                                </v-flex>

                                <v-flex xs12>
                                    <v-text-field
                                        v-model="editedItem.pais"
                                        label="pais"
                                    ></v-text-field>
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
            { text: "Nome", value: "nome" },
            { text: "Email", value: "email" },
            { text: "Celular", value: "celular" },
            { text: "Cpf", value: "cpf" },
            { text: "Actions", value: "action", sortable: false }
        ],
        tableData: [],
        editedIndex: -1,
        allEstados: [],
        editedItem: {
            nome: "",
            email: "",
            celular: "",
            fixo: "",
            cpf: "",
            cep: "",
            rua: "",
            numero: "",
            complemento: "",
            bairro: " ",
            cidade: "",
            uf: "",
            pais: "",
            created_at: ""
        },
        defaultItem: {
            nome: "",
            email: "",
            celular: "",
            fixo: "",
            cpf: "",
            cep: "",
            rua: "",
            numero: "",
            complemento: "",
            bairro: " ",
            cidade: "",
            uf: "",
            pais: "Brasil",
            created_at: ""
        },
        rules: {
            required: value => !!value || "*Obrigatório",
            counter: value => value.length <= 20 || "Max 20 characters",
            email: value => {
                const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return pattern.test(value) || "Invalid e-mail.";
            }
        }
    }),

    computed: {
        formTitle() {
            return this.editedIndex === -1 ? "New Item" : "Edit Item";
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
            axios.get("/api/proprietarios").then(response => {
                this.tableData = response.data.data;
            });

            axios
                .get("/api/estados")
                .then(response => (this.allEstados = response.data.data));
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
                .delete("/api/proprietarios/" + item.id)
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
                        "/api/proprietarios/" + this.editedItem.id,
                        this.editedItem
                    )
                    .then(response => console.log(response.data));
            } else {
                this.tableData.push(this.editedItem);

                axios
                    .post("/api/proprietarios/", this.editedItem)
                    .then(response => console.log(response.data));
            }
            this.close();
        },
        buscar_cep() {
            console.log("Buscar cep2");
            var url =
                "https://viacep.com.br/ws/" + this.editedItem.cep + "/json/";
            if (/^[0-9]{5}-[0-9]{3}$/.test(this.editedItem.cep)) {
                let axios_instance = axios.create();
                delete axios_instance.defaults.headers.common["X-CSRF-TOKEN"];
                axios_instance.get(url).then(response => {
                    let endereco = response.data;
                    if (!this.editedItem.rua) {
                        this.editedItem.rua = endereco.logradouro;
                        this.editedItem.bairro = endereco.bairro;
                        this.editedItem.cidade = endereco.localidade;
                        this.editedItem.uf = endereco.uf;
                    }
                });
            }
        }
    }
};

// $.getJSON(
//     ,
//     function(endereco) {
//         if (endereco.erro) {
//             this.endereco = {};
//             return;
//         }
// this.editedItem.rua = endereco.logradouro;
// this.editedItem.bairro = endereco.bairro;
// this.editedItem.cidade = endereco.localidade;
// this.editedItem.uf = endereco.uf;
// console.log(endereco);
//     }
// );
</script>
