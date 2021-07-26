<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Mis Vehiculos
      </h2>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div
              class="bg-white p-6 border-t shadow-xl sm:rounded-lg"
              v-for="(vehicle, index) in vehicles"
              v-bind:key="index"
            >
              <div class="flex items-center">
                <svg
                  class="h-8 w-8 text-indigo-500"
                  width="24"
                  height="24"
                  viewBox="0 0 24 24"
                  stroke-width="2"
                  stroke="currentColor"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <path stroke="none" d="M0 0h24v24H0z" />
                  <circle cx="7" cy="17" r="2" />
                  <circle cx="17" cy="17" r="2" />
                  <path
                    d="M5 17h-2v-6l2-5h9l4 5h1a2 2 0 0 1 2 2v4h-2m-4 0h-6m-6 -6h15m-6 0v-5"
                  />
                </svg>
                <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
                  {{ vehicle.license_plate }}
                </div>
                <div style="margin-left: auto" v-if="vehicle.owner">
                  <div class="flex items-center">
                    <div class="text-lg text-gray-600 leading-7 font-semibold">
                      Es Dueño
                    </div>
                    <svg
                      class="ml-2 h-8 w-8 text-indigo-500"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"
                      />
                    </svg>
                  </div>
                </div>
              </div>

              <div class="ml-12">
                <div class="mt-2 text-sm text-gray-500">
                  <p>Nº Chasis: {{ vehicle.vin }}</p>
                  <p>Marca: {{ vehicle.make }}</p>
                  <p>Modelo: {{ vehicle.model }}</p>
                  <p>Año: {{ vehicle.year }}</p>
                  <p>Color: {{ vehicle.color }}</p>
                </div>
                <div class="mt-2">
                  <jet-button
                    type="button"
                    :onclick="
                      'location.href=' +
                      '\'' +
                      route('vehicle.edit', vehicle.id) +
                      '\''
                    "
                    class="mt-2 mr-2"
                  >
                    Editar
                  </jet-button>
                  <jet-button
                    type="button"
                    :onclick="
                      'location.href=' +
                      '\'' +
                      route('vehicle.edit', vehicle.id) +
                      '\''
                    "
                    class="mt-2 mr-2"
                  >
                    Ver
                  </jet-button>
                  <jet-secondary-button @click="actionModal = true">
                        Acciones
                    </jet-secondary-button>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <jet-dialog-modal :show="actionModal" @close="closeActionModal">
        <template #title> Realizar acciones </template>

        <template #content>

          <div class="mt-4">
                <toggle>Corriente</toggle>
          </div>
        </template>

        <template #footer>
          <jet-secondary-button @click="closeActionModal">
            Cancelar
          </jet-secondary-button>
        </template>
      </jet-dialog-modal>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import JetDialogModal from "@/Jetstream/DialogModal";
import JetButton from "@/Jetstream/Button";
import Welcome from "@/Jetstream/Welcome";
import JetSecondaryButton from '@/Jetstream/SecondaryButton';
import Toggle from '@/Components/Toggle'

export default {
  components: {
    AppLayout,
    JetButton,
    JetSecondaryButton,
    JetDialogModal,
    Toggle,
  },
  props: {
    vehicles: Object,
  },
  data() {
    return {
      actionModal: false,
    };
  },
  methods: {
    closeActionModal() {
      this.actionModal = false;
    },
  },
};
</script>
