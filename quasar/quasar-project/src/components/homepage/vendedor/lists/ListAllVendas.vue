<template>
  <div class="q-ma-md">
    <q-card>
        <q-card-section>
            <div class="text-subtitle2 text-bold">
                Lista de Todas as Vendas
            </div>
        </q-card-section>
        <q-card-section>
            <q-list class="row q-gutter-md">
                <div v-for="item in vendas" :key="item" >
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
            vendas: []
        }
    },
    methods:{
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

    },
    created(){
        this.getAllVendas();
    },
})

</script>
