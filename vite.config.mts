import { defineConfig, splitVendorChunkPlugin, type Plugin } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";
import { execSync } from "node:child_process";
import { fileURLToPath } from "node:url";
import inertia from "./resources/scripts/vite/inertia-layout";
import tsconfigPaths from "vite-tsconfig-paths";

/**
 * Replacement for vite-plugin-laravel's `watch` option.
 * Regenerates Ziggy routes and types when files in routes/ change.
 */
function ziggy(): Plugin {
  // Set PHP_PATH if php isn't on your PATH (e.g. "./vendor/bin/sail php")
  const php = process.env.PHP_PATH ?? "php";

  const generate = () => {
    try {
      execSync(
        `${php} artisan ziggy:generate resources/scripts/utils/ziggy/index.ts`,
        { stdio: "inherit" },
      );
      execSync(
        `${php} artisan ziggy:type resources/scripts/types/ziggy.d.ts`,
        { stdio: "inherit" },
      );
    } catch (e) {
      console.error("[ziggy] generation failed", e);
    }
  };

  return {
    name: "ziggy-generate",
    configureServer(server) {
      const onRouteFile = (file: string) => {
        if (file.replace(/\\/g, "/").includes("/routes/")) generate();
      };
      server.watcher.add("routes/**");
      server.watcher.on("change", onRouteFile);
      server.watcher.on("add", onRouteFile);
    },
  };
}

export default defineConfig({
  plugins: [
    inertia(),
    laravel({
      input: "resources/scripts/main.ts",
      refresh: true, // full reload on Blade/route changes
    }),
    vue({
      template: {
        transformAssetUrls: { base: null, includeAbsolute: false },
      },
    }),
    tsconfigPaths(),
    ziggy(),
    splitVendorChunkPlugin(), // deprecated since Vite 5.2, drop if you don't need it
  ],
  resolve: {
    alias: {
      // Keep these in sync with "paths" in tsconfig.json
      "@components": fileURLToPath(
        new URL("./resources/views/components", import.meta.url),
      ),
      "@": fileURLToPath(new URL("./resources", import.meta.url)),
    },
  },
});