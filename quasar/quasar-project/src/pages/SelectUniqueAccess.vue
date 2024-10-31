<template>
    <div>
        <q-card>
            <q-card-section>
                <q-btn
                    style="width:50%;"
                    color="primary"
                    label="Vendedor"
                    @click="$router.push('/HomeVendedor')"
                />

                <q-btn
                    style="width:50%;"
                    color="primary"
                    label="Gestor"
                    @click="$router.push('/HomeGestor')"
                />
            </q-card-section>
        </q-card>
    </div>



</template>
<script>
import { defineComponent } from 'vue';
export default defineComponent({
    data(){
        return {

        }
    },
    methods:{

    },

})

</script>
