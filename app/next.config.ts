import type { NextConfig } from "next";

// Allow self-signed certificates for local Herd/Valet domains
process.env.NODE_TLS_REJECT_UNAUTHORIZED = '0';

const nextConfig: NextConfig = {
  images: {
    domains: ['localhost', 'api.example.com', 'placehold.co', 'portfolio.test', 'i.pravatar.cc'],
  },
};

export default nextConfig;
