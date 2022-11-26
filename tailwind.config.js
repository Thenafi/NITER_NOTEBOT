module.exports = {
  daisyui: {
    themes: [
      {
        mytheme: {
          primary: "#111111",
          secondary: "#06b6d4",
          accent: "#f7beb4",
          neutral: "#1A2229",
          "base-100": "#d0efff",
          info: "#51B1F6",
          success: "#18954E",
          warning: "#EC9F22",
          error: "#F02861",
        },
      },
    ],
  },
  plugins: [require("daisyui"), require("@tailwindcss/forms")],
};
