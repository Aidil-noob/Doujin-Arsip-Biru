// Initialize Vercel Speed Insights
// This script will be bundled and deployed with the site
import { injectSpeedInsights } from '@vercel/speed-insights';

// Initialize Speed Insights when the script loads
injectSpeedInsights({
  debug: false,
});
