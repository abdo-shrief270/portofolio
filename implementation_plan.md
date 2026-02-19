# Implement Missing Requirements Plan

This plan aims to add the missing modules identified in our comparison report to bring the project to 100% compliance with `portfolio-plan-v2`.

## Proposed Changes

### Backend API (`api/`)
I will generate the missing controllers and add their corresponding routes to [routes/api.php](file:///d:/Work/My%20Project/api/routes/api.php):

#### [NEW] `app/Http/Controllers/Api/V1/Admin/DnsController.php`
- Controller to handle Hostinger DNS records list endpoint.

#### [NEW] `app/Http/Controllers/Api/V1/Admin/NginxController.php`
- Controller to handle Nginx configurations list endpoint.

#### [MODIFY] [routes/api.php](file:///d:/Work/My%20Project/api/routes/api.php)
- Add `GET /admin/dns/records` pointing to `DnsController@index`.
- Add `GET /admin/nginx/configs` pointing to `NginxController@index`.
- Add `GET /admin/nginx/configs/{name}` pointing to `NginxController@show`.
- Add `POST /admin/projects/{id}/credentials` pointing to `AdminProjectController@credentials`.
- Add `GET /projects/{slug}/og-image` pointing to `ProjectController@ogImage`.

#### [MODIFY] `app/Http/Controllers/Api/V1/Admin/ProjectController.php`
- Add `credentials(Request $request, $id)` method stub.

#### [MODIFY] `app/Http/Controllers/Api/V1/ProjectController.php`
- Add `ogImage(Request $request, $slug)` method stub.

*(Note: The plan mentioned a Reverb WebSocket endpoint `/api/v1/admin/terminal/connect` but we already have `TerminalController::execute` present which suggests terminal commands via HTTP or standard WS channels. I will add a proxy endpoint or stub to match exactly if needed, though Reverb usually operates via standard Echo channels. I will leave the existing `TerminalController::execute` as it is or add `connect` stub).*

---

### Frontend Next.js App (`app/`)
I will use the terminal to run installation commands for the missing packages and UI components.

#### Terminal Commands to Execute:
```bash
# General Dependencies
cd "d:\Work\My Project\app"
npm install zustand nuqs xterm @xterm/addon-fit @xterm/addon-web-links

# Shadcn UI Components
npx shadcn@latest add scroll-area aspect-ratio collapsible radio-group calendar date-picker -y
```

## Verification Plan

### Automated Tests
- Run `php artisan route:list | grep dns` to confirm the backend routes exist.
- Run `npm ls zustand` and `npm ls xterm` in the frontend to verify package installations.

### Manual Verification
- Review the [package.json](file:///d:/Work/My%20Project/api/package.json) file in `app/` confirming all dependencies match the plan exactly.
- Review [routes/api.php](file:///d:/Work/My%20Project/api/routes/api.php) to confirm all endpoints are present.
