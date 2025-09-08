export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
    ],
    theme: {
        extend: {
            colors: {
                brand: {
                    950: '#05090C',
                    900: '#070E13',
                    800: '#183040',
                    700: '#24495F',
                    600: '#2F5E7A',
                    500: '#BF3612',
                    400: '#F24F09',
                    300: '#FF8A57',
                },
            },
            boxShadow: {
                soft: '0 12px 28px -10px rgba(7,14,19,.35)',
                card: '0 6px 16px -6px rgba(7,14,19,.25)',
                glow: '0 0 0 6px rgba(242,79,9,0.12)',
            },
            backgroundImage: {
                'grid-faint':
                    'linear-gradient(to bottom, rgba(255,255,255,.04), rgba(255,255,255,.04)), radial-gradient(50% 50% at 50% 0%, rgba(255,255,255,.06) 0%, rgba(255,255,255,0) 60%)',
                'hero-gradient':
                    'radial-gradient(1200px 600px at 10% -20%, rgba(242,79,9,.25), transparent 60%), radial-gradient(800px 500px at 110% 10%, rgba(191,54,18,.28), transparent 55%), linear-gradient(180deg, #0A141B 0%, #12202A 100%)',
            },
            borderRadius: {
                xl2: '1.25rem',
            },
        },
    },
};
