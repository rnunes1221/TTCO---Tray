<template>
  <div class="q-ma-md">
    <q-card class="q-pa-md">
        <q-card-section>
            <div class="text-subtitle2 text-bold">
                Filtro de Pessoas Por Papel
            </div>
        </q-card-section>
        <q-card-section>
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
        </q-card-section>

        <q-card-section>
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

                            <q-btn icon="local_grocery_store" dense color="secondary" size="09px">
                                <q-tooltip>
                                    Criar Venda
                                </q-tooltip>
                                <q-popup-proxy>
                                    <q-banner>
                                        <q-input
                                            type="number"
                                            step="0.01"
                                            label="Digite um valor decimal"
                                            hint="Exemplo: 10.50"
                                            min="0"
                                            v-model="valor"
                                        />
                                        <q-btn
                                            :disable="valor && valor > 0 ? false : true"
                                            class="full-width"
                                            label="Salvar"
                                            color="primary"
                                            icon="save"
                                            @click="createVenda(item.id, valor)"
                                        />
                                    </q-banner>
                                </q-popup-proxy>
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
                            Gestor:{{ item.gestor }}
                        </q-card-section>
                        <q-separator />
                    </q-card>
                </div>
            </q-list>
        </q-card-section>
    </q-card>
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
            papel: null,
            valor: null
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

        createVenda(id, valor){
            this.$api.post(`venda/createVenda`,{
                pessoa:id,
                valor:valor
            })
            .then((res) =>{
                this.$q.notify({
                    closeBtn: true,
                    timeout: 3000,
                    message: `${res.data.message}`,
                });
            })
        },
    },
    beforeMount(){
        this.getAllPapel();
    },
})

</script>
