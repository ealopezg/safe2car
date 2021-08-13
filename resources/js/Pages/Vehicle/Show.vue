<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Vehículo {{ vehicle.license_plate }}
      </h2>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-5 md:gap-4 gap-y-2 gap-x-0">
          <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="border-t border-gray-200">
              <dl>
                <div
                  class="
                    bg-gray-50
                    px-4
                    py-5
                    sm:grid sm:grid-cols-3
                    sm:gap-4
                    sm:px-6
                  "
                >
                  <dt class="text-sm font-medium text-gray-500">Patente</dt>
                  <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{ vehicle.license_plate }}
                  </dd>
                </div>
                <div
                  class="
                    bg-white
                    px-4
                    py-5
                    sm:grid sm:grid-cols-3
                    sm:gap-4
                    sm:px-6
                  "
                >
                  <dt class="text-sm font-medium text-gray-500">Chasis</dt>
                  <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{ vehicle.vin }}
                  </dd>
                </div>
                <div
                  class="
                    bg-gray-50
                    px-4
                    py-5
                    sm:grid sm:grid-cols-3
                    sm:gap-4
                    sm:px-6
                  "
                >
                  <dt class="text-sm font-medium text-gray-500">Modelo</dt>
                  <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{ vehicle.make }} {{ vehicle.model }} {{ vehicle.year }}
                  </dd>
                </div>
                <div
                  class="
                    bg-white
                    px-4
                    py-5
                    sm:grid sm:grid-cols-3
                    sm:gap-4
                    sm:px-6
                  "
                >
                  <dt class="text-sm font-medium text-gray-500">Color</dt>
                  <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{ vehicle.color }}
                  </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:gap-4 sm:px-6">
                    <div class="grid grid-cols-2 gap-2">
                        <jet-secondary-button> Acciones </jet-secondary-button>
                        <jet-secondary-button @click="generateToken()"> Token </jet-secondary-button>
                    </div>

                </div>
              </dl>
            </div>
          </div>
          <div class="col-span-4 bg-white shadow overflow-hidden sm:rounded-lg">
            <l-map
              v-model="zoom"
              v-model:zoom="zoom"
              :center="vehicle.locations.length > 0 ? [vehicle.locations[0].lat,vehicle.locations[0].lng] : [-33.368335929676135, -70.66712776934384]"
               style="z-index: 0;"
            >
              <l-tile-layer
                url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
                :attribution="attribution"
              ></l-tile-layer>
              <l-marker v-for="location,index in vehicle.locations" v-bind:key="index" :lat-lng="[location.lat, location.lng]">
                <l-tooltip>{{location.added_at}}</l-tooltip>
              </l-marker>
            </l-map>
          </div>

          <div class="col-span-2 bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="p-6 border-t border-gray-200">
              <div class="flex items-center">
                <svg
                  fill="none"
                  stroke="currentColor"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  viewBox="0 0 24 24"
                  class="w-8 h-8 text-gray-400"
                >
                  <path
                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                  ></path>
                </svg>
                <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
                  <a href="https://tailwindcss.com/">Fotos</a>
                </div>
              </div>
              <div class="ml-12">
                <div class="mt-2 text-sm text-gray-500">
                  Ultimas fotos del interior
                </div>
              </div>
              <section class="py-8 px-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 -mx-4 -mb-8">
                    <div  @click="this.photoModal = true">
                  <img

                    class="rounded shadow-md"
                    src="https://images.unsplash.com/photo-1471174617910-3e9c04f58ff5?ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8Y2FyJTIwaW50ZXJpb3J8ZW58MHx8MHx8&ixlib=rb-1.2.1&w=1000&q=80"
                    alt=""
                  />
                    </div>
                  <img
                    class="rounded shadow-md"
                    src="https://images.unsplash.com/photo-1471174617910-3e9c04f58ff5?ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8Y2FyJTIwaW50ZXJpb3J8ZW58MHx8MHx8&ixlib=rb-1.2.1&w=1000&q=80"
                    alt=""
                  />
                  <img
                    class="rounded shadow-md"
                    src="https://images.unsplash.com/photo-1471174617910-3e9c04f58ff5?ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8Y2FyJTIwaW50ZXJpb3J8ZW58MHx8MHx8&ixlib=rb-1.2.1&w=1000&q=80"
                    alt=""
                  />
                  <img
                    class="rounded shadow-md"
                    src="https://images.unsplash.com/photo-1471174617910-3e9c04f58ff5?ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8Y2FyJTIwaW50ZXJpb3J8ZW58MHx8MHx8&ixlib=rb-1.2.1&w=1000&q=80"
                    alt=""
                  />
                  <img
                    class="rounded shadow-md"
                    src="https://images.unsplash.com/photo-1471174617910-3e9c04f58ff5?ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8Y2FyJTIwaW50ZXJpb3J8ZW58MHx8MHx8&ixlib=rb-1.2.1&w=1000&q=80"
                    alt=""
                  />
                </div>
              </section>
            </div>
          </div>
          <div class="col-span-3 bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="p-6 border-t border-gray-200">
              <div class="flex items-center">
                <svg
                  fill="none"
                  stroke="currentColor"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  viewBox="0 0 24 24"
                  class="w-8 h-8 text-gray-400"
                >
                  <path
                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"
                  ></path>
                </svg>

                <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
                  <a href="https://tailwindcss.com/">Historial</a>
                </div>
              </div>
              <div class="flex flex-col">
                <div class="-my-2 sm:-mx-6 lg:-mx-8">
                  <div
                    class="
                      py-2
                      align-middle
                      inline-block
                      min-w-full
                      sm:px-6
                      lg:px-8
                    "
                  >
                    <div
                      class="
                        shadow
                        overflow-hidden
                        border-b border-gray-200
                        sm:rounded-lg
                      "
                    >
                      <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                          <tr>
                            <th
                              scope="col"
                              class="
                                px-6
                                py-3
                                text-left text-xs
                                font-medium
                                text-gray-500
                                uppercase
                                tracking-wider
                              "
                            >
                              Fecha
                            </th>
                            <th
                              scope="col"
                              class="
                                px-6
                                py-3
                                text-left text-xs
                                font-medium
                                text-gray-500
                                uppercase
                                tracking-wider
                              "
                            >
                              Descripcion
                            </th>

                            <th scope="col" class="relative px-6 py-3">
                              <span class="sr-only">Ver</span>
                            </th>
                          </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                          <tr v-for="(h, index) in vehicle.statuses" v-bind:key="index">
                            <td class="px-6 py-4 whitespace-nowrap">
                              <div class="text-sm text-gray-500">
                                {{ h.added_at }}
                              </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                              <div class="text-sm text-gray-900">
                                {{ h.action }} - {{ h.comment }}
                              </div>
                            </td>
                            <td
                              class="
                                px-6
                                py-4
                                whitespace-nowrap
                                text-right text-sm
                                font-medium
                              "
                            >
                              <a
                                href="#"
                                class="text-indigo-600 hover:text-indigo-900"
                                >Ver</a
                              >
                            </td>
                          </tr>

                          <!-- More people... -->
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <jet-dialog-modal :show="tokenModal" @close="this.tokenModal = false">
        <template #title> Token Generado </template>

        <template #content>
            <h1>Utilice el siguiente token y configurelo en el config.ini del raspberry</h1>
            {{ token }}
        </template>

        <template #footer>
          <jet-secondary-button @click="this.tokenModal = false">
            Cerrar
          </jet-secondary-button>
        </template>
      </jet-dialog-modal>
    <jet-dialog-modal :show="photoModal" @close="this.photoModal = false">
        <template #title>Imagen </template>

        <template #content>

            <img
            class="rounded shadow-md"
            :src="photoModalImage"
            alt=""
            />
        </template>

        <template #footer>
            <jet-secondary-button @click.prevent="downloadImage" class="mt-2 mr-2">
            Descargar
          </jet-secondary-button>
          <jet-secondary-button @click="this.photoModal = false">
            Cerrar
          </jet-secondary-button>
        </template>
      </jet-dialog-modal>
  </app-layout>
</template>

<script>
import {
  LMap,
  LIcon,
  LTileLayer,
  LMarker,
  LControlLayers,
  LTooltip,
  LPopup,
  LPolyline,
  LPolygon,
  LRectangle,
  LControlAttribution,
} from "@vue-leaflet/vue-leaflet";
import "leaflet/dist/leaflet.css";
import AppLayout from "@/Layouts/AppLayout";
import JetDialogModal from "@/Jetstream/DialogModal";
import JetButton from "@/Jetstream/Button";
import Welcome from "@/Jetstream/Welcome";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import Toggle from "@/Components/Toggle";
import axios from 'axios';
export default {
  components: {
    AppLayout,
    JetButton,
    JetSecondaryButton,
    JetDialogModal,
    Toggle,
    LMap,
    LIcon,
    LTileLayer,
    LMarker,
    LControlLayers,
    LTooltip,
    LPopup,
    LPolyline,
    LPolygon,
    LRectangle,
    LControlAttribution
  },
  props: {
    vehicle: Object,
  },
  data() {
    return {
      actionModal: false,
      tokenModal: false,
      token: "",
      zoom: 10,
      attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
      iconWidth: 25,
      iconHeight: 40,
      photoModal: false,
      photoModalImage: "https://images.unsplash.com/photo-1471174617910-3e9c04f58ff5?ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8Y2FyJTIwaW50ZXJpb3J8ZW58MHx8MHx8&ixlib=rb-1.2.1&w=1000&q=80",
      history: [
        {
          date: "17-2-2021 21:20hrs",
          description: "Foto tomada",
        },
        {
          date: "17-2-2021 21:20hrs",
          description: "Ubicación obtenida",
        },
        {
          date: "17-2-2021 21:20hrs",
          description: "Ubicación obtenida",
        },
        {
          date: "17-2-2021 21:20hrs",
          description: "Ubicación obtenida",
        },
        {
          date: "17-2-2021 21:20hrs",
          description: "Ubicación obtenida",
        },
      ],
    };
  },
  computed: {
    iconUrl() {
      return `https://placekitten.com/${this.iconWidth}/${this.iconHeight}`;
    },
    iconSize() {
      return [this.iconWidth, this.iconHeight];
    },
  },
  methods: {
    closeActionModal() {
      this.actionModal = false;
    },
    downloadImage(){
        window.open(this.photoModalImage+'.jpg', '_blank')
    },
    generateToken(){
        this.isLoading = true;

        axios.post(this.vehicle.id+'/api').then((response) => {
           this.token = response.data;
           this.tokenModal = true;
           this.isLoading = false;
        })
    },
    log(a) {
      console.log(a);
    },
    changeIcon() {
      this.iconWidth += 2;
      if (this.iconWidth > this.iconHeight) {
        this.iconWidth = Math.floor(this.iconHeight / 2);
      }
    },
  },
};
</script>
