<template>
  <div>
    <jet-dialog-modal :show="show" @close="closeModal()">
      <template #title> Realizar acciones </template>

      <template #content>
        <div class="mt-4 grid grid-cols-1 justify-items-center">
          <div
            class="grid md:grid-cols-3 gap-2 grid-cols-1 justify-items-start"
          >
            <div>
              <Toggle
                labelledby="toggle-label"
                v-model="system"
                @change="clickAction('system', true, system)"
              />
              <label id="toggle-label"> Sistema</label>
            </div>
            <div>
              <Toggle
                labelledby="toggle-label"
                v-model="buzzer"
                @change="clickAction('buzzer', true, buzzer)"
              />
              <label id="toggle-label"> Bocina</label>
            </div>
            <div>
              <Toggle
                labelledby="toggle-label"
                v-model="power_cut_off"
                @change="clickAction('power_cut_off', true, power_cut_off)"
              />
              <label id="toggle-label"> Corta Corriente</label>
            </div>
          </div>
          <div
            class="
              grid
              md:grid-cols-3
              mt-4
              grid-cols-1
              gap-4
              justify-items-center
            "
          >
            <div>
              <jet-secondary-button @click="clickAction('photo')">
                Tomar fotografía
              </jet-secondary-button>
            </div>
            <div>
              <jet-secondary-button @click="clickAction('location')">
                Obtener Ubicación
              </jet-secondary-button>
            </div>
            <div>
              <jet-secondary-button @click="clickAction('call')">
                Realizar llamada
              </jet-secondary-button>
            </div>
          </div>
        </div>
      </template>

      <template #footer>
        <jet-secondary-button @click="closeModal()">
          Cerrar
        </jet-secondary-button>
      </template>
    </jet-dialog-modal>
  </div>
</template>
<script>
import axios from 'axios';
import Toggle from "@vueform/toggle";
import JetDialogModal from "@/Jetstream/DialogModal";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";

export default {
    components: {
        Toggle,
        JetDialogModal,
        JetSecondaryButton
    },
    data(){
        return{
            system: false,
            buzzer: false,
            power_cut_off: false,
        }

    },
    props: ['vehicleId','show','isLoading'],
    emits: ['closed','isLoading','isNotLoading'],
    methods: {
        closeModal(){
            this.$emit('closed')
        },
        clickAction(action,toggle=false,toggleValue = null) {
            if(toggle){
                action = action + '_' + (toggleValue ? 'activate' : 'deactivate');
            }
            this.$emit('isLoading')
            axios.post(route('vehicle.action',{id: this.vehicleId}),{action}).then((response) => {
            this.$emit('isNotLoading')
            })
        },
        setState(){
            axios.get(route('vehicle.state',{id: this.vehicleId})).then((response) => {
                this.system = response.data.system;
                this.buzzer = response.data.buzzer;
                this.power_cut_off = response.data.cut_off_power
            })
        }
    },
    watch: {
      	show: function(newVal, oldVal) {
          if(newVal){
              this.setState();
          }
        }
      }

}
</script>
<style src="@vueform/toggle/themes/default.css"></style>
