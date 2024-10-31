<template>
  <div class="q-ma-md">
    <q-select
        outlined
        class="full-width"
        placeholder="Pesquisar"
        v-model="papel"
        :options="optionsPapel"
        use-input
        emit-value
        option-label="nome"
        :option-value=optionsPapel
        debounce="800"
    />

    <q-btn
        label="Filtrar"
        color="primary"
        @click="getAllPessoaByPapel(papel)"
    />

    <q-list class="row q-gutter-md">
        <div v-for="item in pessoas" :key="item">
            <div class="text-subtitle2">
                Pessoas
                <q-icon name="people" size="30px" color="primary"/>
            </div>

            <q-card class="col">
                <q-card-section>
                    ID: {{ item.id }}
                </q-card-section>

                <q-card-section>
                    Nome:{{ item.nome }}
                </q-card-section>

                <q-card-section>
                    Email:{{ item.email }}

                    <q-btn icon="edit" dense color="secondary" size="09px">
                        <q-tooltip>
                            Editar Pessoa
                        </q-tooltip>
                        <q-popup-proxy>
                            <q-banner>
                                <q-input v-model="item.nome"/>
                                <q-input v-model="item.email"/>
                                <q-btn
                                    class="full-width"
                                    label="Salvar"
                                    color="primary"
                                    icon="save"
                                    @click="editPessoa(item.id, item.nome, item.email)"
                                />
                            </q-banner>
                        </q-popup-proxy>
                    </q-btn>
                    <q-btn icon="delete" dense color="negative" size="09px" @click="deletePessoa(item.id, papel)">
                        <q-tooltip>
                            Excluir Pessoa
                        </q-tooltip>
                    </q-btn>
                </q-card-section>
                <q-separator />
            </q-card>
        </div>

        <div class="col" v-for="item in papeis" :key="item">
            <div class="text-subtitle2">
                Papeis
                <q-icon name="description" size="30px" color="primary"/>
            </div>
            <q-card class="col">
                <q-card-section>
                    ID: {{ item.id }}
                </q-card-section>

                <q-card-section>
                    Nome:{{ item.nome }}
                </q-card-section>

                <q-card-section>
                    Email:{{ item.gestor }}
                </q-card-section>
                <q-separator />
            </q-card>
        </div>

    </q-list>
  </div>
</template>
<script>
import { defineComponent } from 'vue';
export default defineComponent({
    data(){
        return {
            papeis: [],
            pessoas: [],
            optionsPapel: [],
            papel: null
        }
    },
    methods:{
        getAllPessoaByPapel(papel){
            const id = papel.id
            this.$api.post(`papelpessoa/getAllPessoaByPapel`,{
                papel:id
            })
            .then((res) =>{
                this.papeis = [];
                this.pessoas = [];
                this.papeis = res.data[0].papeis;
                this.pessoas = res.data[0].pessoas;
            })
        },

        getAllPapel(){
            this.$api.get(`papel/getAllPapel`)
            .then((res) =>{
                this.optionsPapel = res.data;
            })
        },

        editPessoa(id,nome,email){
            this.$api.post(`pessoa/editPessoa`,{
                id:id,
                nome:nome,
                email:email
            })
            .then((res) =>{
                this.$q.notify({
                    closeBtn: true,
                    timeout: 3000,
                    message: `${res.data.message}`,
                });
            })
        },

        deletePessoa(id, papel){
            this.$api.post(`pessoa/deletePessoa`,{
                id:id,
            })
            .then((res) =>{
                this.$q.notify({
                    closeBtn: true,
                    timeout: 3000,
                    message: `${res.data.message}`,
                });

                this.getAllPessoaByPapel(papel.id)
            })
        },
    },
    beforeMount(){
        this.getAllPapel();
    },
})

</script>
