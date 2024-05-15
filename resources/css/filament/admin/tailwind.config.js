import preset from '../../../../vendor/filament/filament/tailwind.config.preset';

export default {
    presets: [preset],
    content: [
        './app/Filament/**/*.php',
        './resources/views/filament/**/*.blade.php',
        './resources/views/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],
    theme: {
        container: ({ theme }) => ({
            center: true,
            padding: {
                DEFAULT: '1rem',
                sm: '1.5rem',
                lg: '2rem',
            },
            screens: {
                DEFAULT: theme('screens.xl'),
            },
        }),
        extend: {
            colors: {
                primary: {
                    50: '#edf6fa',
                    100: '#dcecf5',
                    200: '#accee6',
                    300: '#81aed6',
                    400: '#376fb8',
                    500: '#003399',
                    600: '#002c8a',
                    700: '#002173',
                    800: '#00185c',
                    900: '#001045',
                    950: '#00092b',
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
};
