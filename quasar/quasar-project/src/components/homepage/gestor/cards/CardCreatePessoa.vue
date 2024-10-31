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
        :option-value="optionsPapel"
        debounce="800"
    />
    <div class="row q-mt-md">
        <div class="col">

            <q-card>
                <div class="text-subtitle2">
                    Cadastro de Pessoa
                </div>

                <q-card-section>
                <q-input
                    v-model="nome"
                    label="Nome"
                    dense
                />
                </q-card-section>

                <q-card-section>
                    <q-input
                    label="Email"
                    v-model="email"
                    dense
                    />
                </q-card-section>
                <q-card-section >
                    <q-btn
                        :disable="papel ? false : true"
                        class="full-width"
                        label="Salvar"
                        icon="send"
                        text-color="white"
                        color="positive"
                        @click="createPessoa(nome,email,papel)"
                    />
                </q-card-section>
            </q-card>
        </div>

        <div class="col">
            <q-card>
                <div class="text-subtitle2">
                    Cadastro de Papel
                </div>
                <q-card-section>
                    <q-input
                        v-model="nome_papel"
                        label="Nome"
                        dense
                    />
                </q-card-section>

                <q-checkbox size="72px" label="Gestor ?" v-model="gestor" true-value="Y" false-value="N"/>

                <q-card-section >
                    <q-btn class="full-width" label="Salvar" icon="send" text-color="white" color="positive" @click="createPapel(nome_papel,gestor)" />
                </q-card-section>
            </q-card>
        </div>
    </div>
  </div>
</template>
<script>
import { defineComponent } from 'vue';

export default defineComponent({
    data(){
        return {
            optionsPapel: [],
            papel: null,
            nome_papel: null,
            nome:null,
            email:null,
            gestor:'N'
        }
    },
    methods:{
        getAllPapel(){
            this.$api.get(`papel/getAllPapel`)
            .then((res) =>{
                this.optionsPapel = [];
                this.optionsPapel = res.data;
            })
        },

        createPessoa(nome,email,papel){
            this.$api.post(`pessoa/createPessoa`,{
                nome:nome,
                email:email,
                papel:papel.id
            })
            .then((res) =>{
                this.$q.notify({
                    closeBtn: true,
                    timeout: 3000,
                    message: `${res.data.message}`,
                });
                this.nome = null;
                this.email = null;
                this.papel = null;
            })
        },

        createPapel(nome_papel,gestor){
            this.$api.post(`papel/createPapel`,{
                nome:nome_papel,
                gestor:gestor
            })
            .then((res) =>{
                this.$q.notify({
                    closeBtn: true,
                    timeout: 3000,
                    message: `${res.data.message}`,
                });
                this.getAllPapel();
                this.nome_papel = null;
                this.gestor = 'N'
            })
        },
    },
    created(){
        this.getAllPapel();
    }
});

</script>
