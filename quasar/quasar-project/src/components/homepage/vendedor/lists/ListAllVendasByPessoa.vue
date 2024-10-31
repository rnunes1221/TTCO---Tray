<template>
    <div class="q-ma-md">
        <q-card>
            <q-card-section>
                <div class="text-subtitle2 text-bold">
                    Lista de Todas as Vendas Por Pessoa
                </div>
            </q-card-section>
            <q-card-section>
                <q-select
                    outlined
                    class="full-width"
                    placeholder="Pesquisar"
                    v-model="pessoa"
                    :options="optionsPessoa"
                    use-input
                    emit-value
                    option-label="nome"
                    :option-value=optionsPessoa
                    debounce="800"
                />
                <q-btn
                    label="Filtrar"
                    color="primary"
                    dense
                    @click="getAllVendasByPessoa(pessoa)"
                />

                <q-list class="row q-gutter-md">
                    <div v-for="item in vendasPessoa" :key="item" >
                        <div class="text-subtitle2 text-bold">
                            Venda
                            <q-icon name="local_grocery_store" size="30px" color="primary"/>
                        </div>

                        <q-card class="row">
                            <q-card-section>
                                Data: {{ item.data }}
                            </q-card-section>

                            <q-card-section>
                                Id Vendedor:{{ item.vendedor[0].id }}
                            </q-card-section>

                            <q-card-section>
                                <q-icon name="person" size="20px" color="primary"/>
                                Nome Vendedor:{{ item.vendedor[0].nome }}
                            </q-card-section>

                            <q-card-section>
                                <q-icon name="mail" size="20px" color="primary"/>
                                Email Vendedor:{{ item.vendedor[0].email }}
                            </q-card-section>

                            <q-card-section>
                                <q-icon name="payments" size="20px" color="green"/>
                                Valor:{{ item.valor }}
                            </q-card-section>

                            <q-card-section>
                                <q-icon name="payments" size="20px" color="green"/>
                                Valor:{{ item.valor }}
                            </q-card-section>

                            <q-card-section>
                                <q-icon name="attach_money" size="20px" color="green"/>
                                Comissao:{{ calcularComissao(item.valor).toFixed(2) }}
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
            vendas: [],
            optionsPessoa: [],
            pessoa: null,
            vendasPessoa: []
        }
    },
    methods:{

        calcularComissao(valor) {
            const percentual = 8.5 / 100; // Convertendo para decimal
            const comissao = valor * percentual; // Calculando a comissão
            return comissao;
        },
        getAllPessoas(){
            this.$api.get(`pessoa/getAllPessoa`)
            .then((res) =>{
                this.optionsPessoa = [];
                if(res.data.length > 0)
                {
                    this.optionsPessoa = res.data
                }
            })
        },

        getAllVendas(){
            this.$api.get(`venda/getAllVendas`)
            .then((res) =>{
                this.vendas = [];
                if(res.data.length > 0)
                {
                    res.data.map(item => ({}));
                    this.vendas = res.data;
                }
            })
        },

        getAllVendasByPessoa(pessoa){
            this.$api.post(`venda/getAllVendasByPessoa`,{
                pessoa:pessoa.id
            })
            .then((res) =>{
                this.vendasPessoa = [];
                if(res.data.length > 0)
                {
                    res.data.map(item => ({}));
                    this.vendasPessoa = res.data;
                }
            })
        },

    },
    created(){
        this.getAllPessoas();
    },
})

</script>
