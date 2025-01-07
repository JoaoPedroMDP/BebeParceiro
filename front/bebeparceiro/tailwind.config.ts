import type { Config } from "tailwindcss";

export default {
  content: [
    "./src/pages/**/*.{js,ts,jsx,tsx,mdx}",
    "./src/components/**/*.{js,ts,jsx,tsx,mdx}",
    "./src/app/**/*.{js,ts,jsx,tsx,mdx}",
  ],
  theme: {
    extend: {
      colors: {
        background: "var(--background)",
        foreground: "var(--foreground)",
        lightGreen: "#FFEFCE",
        darkGreen: "#665635",
        rightGreen: "#4ADE80",
        wrongRed: "#DC2626",
        warningYellow: "#FBBF24",
      },
      animation: {
        grow: "grow 1.5s infinite",
      },
      keyframes: {
        grow: {
          "0%, 100%": {
            transform: "scale(1)",
          },
          "50%": {
            transform: "scale(1.1)",
          },
        },
      }
    },
  },
  plugins: [],
} satisfies Config;
