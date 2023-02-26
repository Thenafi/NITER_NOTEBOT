
import { ModuleOptions } from './module'

declare module '@nuxt/schema' {
  interface NuxtConfig { ['image']?: Partial<ModuleOptions> }
  interface NuxtOptions { ['image']?: ModuleOptions }
}


export { $Img, CloudinaryModifiers, CloudinaryOptions, CreateImageOptions, ImageCTX, ImageInfo, ImageModifiers, ImageModuleProvider, ImageOptions, ImageProvider, ImageProviders, ImageSize, ImageSizes, ImageSizesOptions, Img, InputProvider, MapToStatic, ModuleOptions, OperationFormatter, OperationGeneratorConfig, OperationMapper, ProviderGetImage, ProviderSetup, ResolvedImage, RuntimePlaceholder, default } from './module'
