import { ComputedRef, Ref } from 'vue'
export type LayoutKey = "default" | "frontpage"
declare module "D:/Github/NITER_NOTEBOT/node_modules/nuxt/dist/pages/runtime/composables" {
  interface PageMeta {
    layout?: false | LayoutKey | Ref<LayoutKey> | ComputedRef<LayoutKey>
  }
}