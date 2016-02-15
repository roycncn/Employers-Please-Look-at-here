import java.io.*;
import java.net.URL;
import java.net.URLConnection;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.HashMap;
import java.util.Iterator;
import java.util.List;
import java.util.Map;

public class test {

	public static void main(String[] args) {
		File ff = new File("C:\\Users\\xxxxxx\\Desktop\\RunTime");

		HashMap<String, String> map = new HashMap();
		DataUtil.listFile(ff, ".zip", map);

		Iterator iter = map.entrySet().iterator();

		while (iter.hasNext()) {
			Map.Entry<String, String> entry = (Map.Entry) iter.next();
			String filename = entry.getKey();
			String filepath = entry.getValue();
			DataUtil.unZip(filepath + "\\" + filename, filepath + "\\" + filename.replace(".zip", "") + "\\");
			System.out.println(filepath + "\\" + filename);

		}
	}

}
