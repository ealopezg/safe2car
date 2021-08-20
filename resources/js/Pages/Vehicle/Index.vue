<template>
  <app-layout>
    <template #header>
      <div class="grid grid-cols-2 justify-start">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Mis Vehiculos
        </h2>
        <jet-button @click="vehicleModal = true" class="justify-self-end">
          Nuevo Vehículo
        </jet-button>
      </div>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <p v-if="vehicles.length == 0">No hay vehículos</p>
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
                      route('vehicle.show', vehicle.id) +
                      '\''
                    "
                    class="mt-2 mr-2"
                  >
                    Ver
                  </jet-button>
                  <jet-secondary-button @click="openActionModal(vehicle.id)" v-if="vehicle.owner">
                    Acciones
                  </jet-secondary-button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <vehicle-action :vehicleId="vehicle_id" :show="actionModal" :isLoading="isLoading" @closed="actionModal = false" @isLoading="isLoading = true" @isNotLoading="isLoading = false"></vehicle-action>
      <jet-dialog-modal :show="vehicleModal" @close="closeVehicleModal">

        <template #title> Nuevo Vehículo </template>

        <template #content>
            <form @submit.prevent="submitVehicle">
            <div class="grid grid-cols-4 gap-5 mt-4">
              <div class="col-span-3 sm:col-span-2">
                <label
                  for="license_plate"
                  class="block text-sm font-medium text-gray-700"
                >
                  Patente
                </label>
                <input
                  type="text"
                  name="license_playe"
                  id="license_plate"
                  v-model="newVehicle.license_plate"
                  class="
                    focus:ring-indigo-500
                    focus:border-indigo-500
                    flex-1
                    block
                    w-full
                    rounded-md
                    sm:text-sm
                    border-gray-300
                  "
                  placeholder="AAAA32"
                />
              </div>
              <div class="col-span-3 sm:col-span-2">
                <label
                  for="vin"
                  class="block text-sm font-medium text-gray-700"
                >
                  Chasis
                </label>
                <input
                  type="text"
                  name="vin"
                  id="vin"
                  v-model="newVehicle.vin"
                  class="
                    focus:ring-indigo-500
                    focus:border-indigo-500
                    flex-1
                    block
                    w-full
                    rounded-md
                    sm:text-sm
                    border-gray-300
                  "
                  placeholder="88888888"
                />
              </div>
              <div class="col-span-3 sm:col-span-2">
                <label
                  for="make"
                  class="block text-sm font-medium text-gray-700"
                >
                  Marca
                </label>
                <input
                  type="text"
                  name="make"
                  id="make"
                  v-model="newVehicle.make"
                  class="
                    focus:ring-indigo-500
                    focus:border-indigo-500
                    flex-1
                    block
                    w-full
                    rounded-md
                    sm:text-sm
                    border-gray-300
                  "
                  placeholder="HYUNDAI"
                />
              </div>
              <div class="col-span-3 sm:col-span-2">
                <label
                  for="model"
                  class="block text-sm font-medium text-gray-700"
                >
                  Modelo
                </label>
                <input
                  type="text"
                  name="model"
                  id="model"
                  v-model="newVehicle.model"
                  class="
                    focus:ring-indigo-500
                    focus:border-indigo-500
                    flex-1
                    block
                    w-full
                    rounded-md
                    sm:text-sm
                    border-gray-300
                  "
                  placeholder="ACCENT"
                />
              </div>
              <div class="col-span-3 sm:col-span-2">
                <label
                  for="year"
                  class="block text-sm font-medium text-gray-700"
                >
                  Year
                </label>
                <input
                  type="text"
                  name="year"
                  id="year"
                  v-model="newVehicle.year"
                  class="
                    focus:ring-indigo-500
                    focus:border-indigo-500
                    flex-1
                    block
                    w-full
                    rounded-md
                    sm:text-sm
                    border-gray-300
                  "
                  placeholder="2021"
                />
              </div>
              <div class="col-span-3 sm:col-span-2">
                <label
                  for="color"
                  class="block text-sm font-medium text-gray-700"
                >
                  Color
                </label>
                <input
                  type="text"
                  name="color"
                  id="color"
                  v-model="newVehicle.color"
                  class="
                    focus:ring-indigo-500
                    focus:border-indigo-500
                    flex-1
                    block
                    w-full
                    rounded-md
                    sm:text-sm
                    border-gray-300
                  "
                  placeholder="Blanco"
                />
              </div>
              <jet-secondary-button @click="closeVehicleModal">
            Cancelar
          </jet-secondary-button>
          <jet-button class="ml-4">
            Guardar
          </jet-button>
            </div>
             </form>
        </template>

        <template #footer>

        </template>

      </jet-dialog-modal>
      <loading v-model:active="isLoading" :is-full-page="true" />
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import JetDialogModal from "@/Jetstream/DialogModal";
import JetButton from "@/Jetstream/Button";
import Welcome from "@/Jetstream/Welcome";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import JetActionMessage from "@/Jetstream/ActionMessage";
import Loading from "vue-loading-overlay";
import axios from 'axios';
import "vue-loading-overlay/dist/vue-loading.css";
import VehicleAction from '@/Components/VehicleAction';
export default {
  components: {
    AppLayout,
    JetButton,
    JetSecondaryButton,
    JetDialogModal,
    Loading,
    JetActionMessage,
    VehicleAction
  },
  props: {
    vehicles: Object,
  },
  data() {
    return {
      actionModal: false,
      vehicleModal: false,
      system: false,
      buzzer: false,
      power_cut_off: false,
      isLoading: false,
      vehicle_id: null,
      newVehicle: this.$inertia.form({
        license_plate: "",
        vin: "",
        make: "",
        model: "",
        year: "",
        color: "",
      }),
    };
  },
  methods: {
    closeActionModal() {
        this.actionModal = false;
    },
    closeVehicleModal() {
        this.vehicle_id = null;
        this.vehicleModal = false;
    },
    openActionModal(vehicle_id){
        this.vehicle_id = vehicle_id;
        this.actionModal = true;
    },
    submitVehicle() {
        this.isLoading = true;
      this.newVehicle.post(this.route('vehicle.store'), {
            onFinish: () => {
                this.newVehicle.reset('license_plate','vin','make','model','year','color');
                this.isLoading = false;
                this.closeVehicleModal();
                },
        })
    },

  },
};
</script>

