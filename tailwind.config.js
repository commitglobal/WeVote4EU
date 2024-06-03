export default {
    content: [
        //,
        './app/Livewire/**/*.php',
        './app/View/Components/**/*.php',
        './resources/views/**/*.blade.php',
    ],
    theme: {
        container: ({ theme }) => ({
            center: true,
            padding: {
                DEFAULT: '1rem',
                sm: '1.5rem',
                lg: '2rem',
            },
        }),
        extend: {
            colors: {
                primary: {
                    50: '#EBF1FF',
                    100: '#D1E0FF',
                    200: '#A8C5FF',
                    300: '#7AA7FF',
                    400: '#4D88FF',
                    500: '#1F69FF',
                    600: '#0052F5',
                    700: '#0042C7',
                    800: '#003399',
                    900: '#001A4D',
                    950: '#000E29',
                },
                secondary: {
                    50: '#fffef2',
                    100: '#fffce6',
                    200: '#fff8bf',
                    300: '#fff199',
                    400: '#ffe14d',
                    500: '#ffcc00',
                    600: '#e6b000',
                    700: '#bf8600',
                    800: '#996100',
                    900: '#734300',
                    950: '#4a2600',
                },
            },
        },
    },
    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
