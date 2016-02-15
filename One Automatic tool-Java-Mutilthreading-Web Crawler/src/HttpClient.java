import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.URL;
import java.net.URLConnection;

public class HttpClient{

	public static String sendGET(String url, String param, String cookie) {
		String result = "";
		BufferedReader read = null;

		try {

			URL realurl = new URL(url + "?" + param);
			URLConnection connection = realurl.openConnection();

			connection.setRequestProperty("accept", "*/*");
			connection.setRequestProperty("connection", "Keep-Alive");
			connection.setRequestProperty("Cookie", cookie);
			connection.setRequestProperty("Referer",
					": http://xxxx/CAisd/pdmweb4.exe?OP=DISPLAY_FORM+SID=1042721101+FID=123+HTMPL=bin_form_np.htmpl");

			connection.connect();

			read = new BufferedReader(new InputStreamReader(connection.getInputStream(), "UTF-8"));
			String line;
			while ((line = read.readLine()) != null) {
				result += line;
			}
		} catch (IOException e) {
			e.printStackTrace();
		} finally {
			if (read != null) {
				try {
					read.close();
				} catch (IOException e) {
					e.printStackTrace();
				}
			}
		}

		return result;
	}

	public static InputStream getInput(String url, String param, String cookie) {
		InputStream ins = null;

		try {
			URL realurl = new URL(url + "?" + param);
			URLConnection connection = realurl.openConnection();
			connection.setRequestProperty("accept", "*/*");
			connection.setRequestProperty("connection", "Keep-Alive");
			connection.setRequestProperty("Cookie", cookie);
			connection.setRequestProperty("Referer", "http://xxxx/CAisd/pdmweb2.exe");

			connection.connect();
			ins = connection.getInputStream();
		} catch (IOException e) {
			e.printStackTrace();
		}
		
		return ins;
	}

}
