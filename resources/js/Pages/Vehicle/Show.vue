<template>
  <app-layout>
    <template #header>
      <!-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Vehículo {{ vehicle.license_plate }}
      </h2>
      <div style="margin-right: auto" v-if="vehicle.owner">
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
                </div> -->
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
                  Vehiculo {{ vehicle.license_plate }}
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
    </template>
    <div class="py-12" ref="header">
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
                  <dt class="text-sm font-medium text-gray-500">
                    Ultima conexión
                  </dt>
                  <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{
                      vehicle.last_connected ? vehicle.last_connected : "Nunca"
                    }}
                  </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:gap-4 sm:px-6">
                  <div class="grid grid-cols-1 gap-2">
                    <jet-secondary-button
                      @click="this.actionModal = true"
                      v-if="this.vehicle.owner"
                    >
                      Acciones
                    </jet-secondary-button>
                    <jet-secondary-button
                      @click="generateToken()"
                      v-if="this.vehicle.owner"
                    >
                      Token
                    </jet-secondary-button>
                    <jet-secondary-button
                      @click="this.inviteModal = true"
                      v-if="this.vehicle.owner"
                    >
                      Invitar a alguien
                    </jet-secondary-button>
                  </div>
                </div>
              </dl>
            </div>
          </div>
          <div
            class="col-span-4 bg-white shadow overflow-hidden sm:rounded-lg"
            style="min-height: 50vh !important"
          >
            <l-map
              ref="theMap"
              v-model="zoom"
              v-model:zoom="zoom"
              :maxZoom="19"
              :center="
                vehicle.locations.length > 0
                  ? [vehicle.locations[0].lat, vehicle.locations[0].lng]
                  : [-33.368335929676135, -70.66712776934384]
              "
              style="z-index: 0"
            >
              <l-tile-layer
                url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
                :attribution="attribution"
              ></l-tile-layer>
              <l-marker
                v-if="vehicle.locations.length > 0"
                :lat-lng="[vehicle.locations[0].lat, vehicle.locations[0].lng]"
                :icon="marker"
              >
                <l-tooltip>{{ vehicle.locations[0].added_at }}</l-tooltip>
              </l-marker>
              <div v-if="vehicle.locations.length > 0">
                <l-marker
                  v-for="(location, index) in vehicle.locations.slice(1)"
                  v-bind:key="index"
                  :lat-lng="[location.lat, location.lng]"
                >
                  <l-tooltip>{{ location.added_at }}</l-tooltip>
                </l-marker>
              </div>
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
                  <div
                    v-for="(photo, index) in vehicle.photos"
                    v-bind:key="index"
                    @click="
                      this.photoModal = true;
                      this.photoModalImage = photo;
                    "
                  >
                    <img class="rounded shadow-md" :src="photo.url" alt="" />
                  </div>
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
                    <div class="shadow border-b border-gray-200 sm:rounded-lg">
                      <table
                        class="
                          table-auto
                          min-w-full
                          max-w-full
                          divide-y divide-gray-200
                        "
                      >
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
                          <tr
                            v-for="(h, index) in vehicle.statuses"
                            v-bind:key="index"
                          >
                            <td class="px-6 py-4">
                              <div class="text-sm text-gray-500">
                                {{ h.added_at }}
                              </div>
                            </td>
                            <td class="px-6 py-4">
                              <div class="text-sm text-gray-900">
                                {{ generateDescription(h) }}
                              </div>
                            </td>
                            <td
                              class="px-6 py-4 text-right text-sm font-medium"
                            >
                              <span v-if="h.received_ok">✓</span
                              ><span v-if="h.received_response">✓</span>
                              <a
                                v-if="
                                  h.action == 'photo' && h.received_response
                                "
                                @click="this.showImage(h)"
                                class="text-indigo-600 hover:text-indigo-900"
                              >
                                Ver</a
                              >
                              <a
                                v-if="
                                  h.action == 'location' && h.received_response
                                "
                                @click="this.centerMap(h)"
                                class="text-indigo-600 hover:text-indigo-900"
                              >
                                Ver</a
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
    <vehicle-action
      :vehicleId="vehicle.id"
      :show="actionModal"
      :isLoading="isLoading"
      @closed="actionModal = false"
      @isLoading="isLoading = true"
      @isNotLoading="isLoading = false"
    ></vehicle-action>
    <jet-dialog-modal :show="tokenModal" @close="this.tokenModal = false">
      <template #title> Token Generado </template>

      <template #content>
        <h1>
          Con el cable LAN del dispositivo conectado a una red, ingrese el token
          en el servidor web del raspberry en el puerto 8080
        </h1>
        {{ token }}
      </template>

      <template #footer>
        <jet-secondary-button @click="this.tokenModal = false">
          Cerrar
        </jet-secondary-button>
      </template>
    </jet-dialog-modal>
    <jet-dialog-modal :show="photoModal" @close="this.photoModal = false">
      <template #title>Imagen - Fecha: {{ photoModalImage.added_at }}</template>

      <template #content>
        <img class="rounded shadow-md" :src="photoModalImage.url" alt="" />
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
    <jet-dialog-modal :show="inviteModal" @close="this.inviteModal = false">
      <template #title> Invitar a alguien a ser dueño </template>

      <template #content>
        <h1>
          Ingrese el email del usuario que le gustaría invitar a ser dueño
        </h1>
        <div class="mt-4">
          <jet-label for="email" value="Email" />
          <jet-input
            id="email"
            type="email"
            class="mt-1 block w-full"
            v-model="inviteForm.email"
            required
          />
        </div>
        <div class="mt-4">
          <jet-label for="owner">
            <div class="flex items-center">
              <jet-checkbox
                name="owner"
                id="owner"
                v-model:checked="inviteForm.owner"
              />

              <div class="ml-2">
                Hacer dueño (puede enviar acciones al dispositivo), de lo contrario solo recibirá notificaciones pero podrá ver las fotos, ubicación y el historial
              </div>
            </div>
          </jet-label>
        </div>
        <div class="mt-4">
            {{ inviteForm.errors}}
        </div>
      </template>

      <template #footer>
        <jet-secondary-button @click="this.invite()" class="mt-2 mr-2">
          Invitar
        </jet-secondary-button>
        <jet-secondary-button @click="this.inviteModal = false">
          Cerrar
        </jet-secondary-button>
      </template>
    </jet-dialog-modal>
    <loading v-model:active="isLoading" :is-full-page="true" />
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
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import Toggle from "@/Components/Toggle";
import axios from "axios";
import VehicleAction from "@/Components/VehicleAction";
import "vue-loading-overlay/dist/vue-loading.css";
import Loading from "vue-loading-overlay";
import JetInput from "@/Jetstream/Input";
import JetLabel from "@/Jetstream/Label";
import JetCheckbox from "@/Jetstream/Checkbox";
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
    LControlAttribution,
    VehicleAction,
    Loading,
    JetInput,
    JetLabel,
    JetCheckbox,
  },
  props: {
    vehicle: Object,
  },
  data() {
    return {
      actions: {
        photo: {
          display: "📸 Foto capturada",
        },
        location: {
          display: "📍 Ubicación obtenida",
        },
        call: {
          display: "📞 Llamada realizada",
        },
        system_activate: {
          display: "✅ Sistema activado",
        },
        system_deactivate: {
          display: "❌  Sistema desactivado",
        },
        buzzer_activate: {
          display: "🔈 Bocina activada",
        },
        buzzer_deactivate: {
          display: "🔇 Bocina desactivada",
        },
        power_cut_off_activate: {
          display: "⚡️ Corta bencina activado",
        },
        power_cut_off_deactivate: {
          display: "⚡️ Corta bencina desactivado",
        },
        motion: {
          display: "😮 Movimiento detectado",
        },
      },
      actionModal: false,
      tokenModal: false,
      token: "",
      zoom: 19,
      attribution:
        '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
      iconWidth: 25,
      iconHeight: 40,
      photoModal: false,
      photoModalImage: {
        id: "",
        url: null,
        added_at: null,
      },
      isLoading: false,
      inviteModal: false,
      inviteForm: {
        email: "",
        owner: false,
        errors: ""
      },
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
      marker: null,
    };
  },
  async beforeMount() {
    const { icon } = await import("leaflet/dist/leaflet-src.esm");
    this.marker = icon({
      iconUrl:
        "https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png",
      shadowUrl:
        "https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png",
      iconSize: [25, 41],
      iconAnchor: [12, 41],
      popupAnchor: [1, -34],
      shadowSize: [41, 41],
    });
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
    invite() {
      axios
        .post(route("vehicle.invite",{ id: this.vehicle.id }),
          {
            email: this.inviteForm.email,
            owner: this.inviteForm.owner,
          }
        )
        .then((response) => {
            this.inviteModal = false;
            this.inviteForm.email = "";
            this.inviteForm.owner = false;
            this.inviteForm.errors = "";
        }).catch((error) => {
            if (error.response){
                if(error.response.status = 404){
                    this.inviteForm.errors = "El usuario no existe"
                }
            }
        });
    },
    closeActionModal() {
      this.actionModal = false;
    },
    downloadImage() {
      window.open(this.photoModalImage.url, "_blank");
    },
    generateToken() {
      this.isLoading = true;

      axios
        .post(route("vehicle.apitoken", { id: this.vehicle.id }))
        .then((response) => {
          this.token = response.data;
          this.tokenModal = true;
          this.isLoading = false;
        });
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
    generateDescription(status) {
      var display = this.actions[status.action].display;
      if (status.action == "call") {
        display = display + " al " + status.args.phone;
      }
      return display;
    },
    centerMap(status) {
      this.$refs.theMap.leafletObject.panTo([
        status.statusable.lat,
        status.statusable.lng,
      ]);
      this.$refs.header.scrollIntoView({ behavior: "smooth" });
      this.zoom = 19;
    },
    showImage(status) {
      this.photoModal = true;
      console.log(status);
      this.photoModalImage = status.statusable;
    },
  },
};
</script>
