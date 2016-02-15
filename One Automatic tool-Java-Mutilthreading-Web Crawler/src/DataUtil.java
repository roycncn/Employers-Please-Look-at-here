import java.io.*
import java.util.*

/**
 * This is a collection of utility
 * @author Roy
 *
 */

public class DataUtil {
	static final int BUFFER = 2048;
	
	/**
 	* The block of String related methods
 	* Will gather information from input
	*
 	* @param content the HTML code of page 
 	*/
	public static String getID(String content) {
		return content.substring(content.indexOf("recordData[\"persid\"]") + 28,
				content.indexOf("recordData[\"persid\"]") + 35);
	}

	public static String getViewState(String content) {
		return content.substring(content.indexOf("javax.faces.ViewState") + 57,
				content.indexOf("javax.faces.ViewState") + 97);
	}

	public static String getPlanID(String content) {
		return content.substring(content.indexOf("KEEP.PLANID=") + 15, content.indexOf("KEEP.PLANID=") + 21);
	}

	public static String getUUID(String content) {
		return content.substring(content.indexOf("+KEEP.UID=") + 13, content.indexOf("+KEEP.UID=") + 45);
	}

	/**
 	* Will access web pages and use getXX method gather infomation
 	* 
	*
 	* @param URL main page URL
 	* @param URL2 implementation plan URL 
 	* @param cookie access cookie 
 	* @param CRNum CO order ID 
 	* @param SID part of cookie
 	*/
	public static HashMap<String, String> preparePara(String URL, String URL2, String cookie, String CRNum,
			String SID) {
		HashMap map = new HashMap();
		;
		String CfgID = null;
		String PlanID = null;
		String UUID = null;
		String ViewState = null;

		String Cfgparam = "OP=SEARCH+SID=" + SID + "+FID=123+FACTORY=chg+QBE.IN.chg_ref_num=" + CRNum;
		CfgID = DataUtil.getID(HttpClient.sendGET(URL, Cfgparam, cookie));
		String Planparam = "SID=" + SID + "+FID=123+OP=SHOW_DETAIL+HTMPL=xx_attmnt_tab.htmpl+FACTORY=chg+PERSID=chg:"
				+ CfgID + "+SDBP_FLAG=1";
		String temp = HttpClient.sendGET(URL, Planparam, cookie);
		UUID = DataUtil.getUUID(temp);
		PlanID = DataUtil.getPlanID(temp);
		String Taskparam = "CR_REF_NUM=" + CRNum + "&USR_UUID=" + UUID + "&IMPL_PLAN_ID=" + PlanID
				+ "&TIMEZONE=Asia/Shanghai";
		String PlanPageHTML = HttpClient.sendGET(URL2, Taskparam, cookie);
		ViewState = DataUtil.getViewState(PlanPageHTML);

		map.put("PlanID", PlanID);
		map.put("ViewState", ViewState);
		map.put("PlanPageHTML", PlanPageHTML);

		return map;

	}

	public static void downloadHandler(InputStream ins, String filePath)
			throws FileNotFoundException, InterruptedException {
		Thread.sleep(500);

		OutputStream os = new FileOutputStream(filePath);
		byte[] b = new byte[8 * 1000];
		int len;
		try {
			while ((len = ins.read(b)) > 0) {
				os.write(b, 0, len);
			}
			os.close();
		} catch (IOException e) {
			e.printStackTrace();

		}

	}

	public static boolean checkFile(String filePath) throws FileNotFoundException {
		File file = new File(filePath);
		if (file.length() < 100) {

			return false;
		} else {
			return true;
		}

	}

	public static void listFile(File fs,String extension, HashMap map) {
		List<File> FileList = new ArrayList<File>();
		FileList = Arrays.asList(fs.listFiles());
		
		for (File file : FileList) {
			if (file.isDirectory()) {
				//map.put(file.getName(), file.getParent());
				listFile(file ,extension ,map);

			} else {
				if (file.getName().contains(extension))
				map.put(file.getName(), file.getParent());

			}

		}
	}

    public static void unZip(String fileName,String filePath){
        
        try {

            ZipFile zipFile = new ZipFile(fileName);
            Enumeration emu = zipFile.entries();
            int i=0;
            while(emu.hasMoreElements()){
                ZipEntry entry = (ZipEntry)emu.nextElement();

                if (entry.isDirectory())
                {
                    new File(filePath + entry.getName()).mkdirs();
                    continue;
                }
                BufferedInputStream bis = new BufferedInputStream(zipFile.getInputStream(entry));
                File file = new File(filePath + entry.getName());

                File parent = file.getParentFile();
                if(parent != null && (!parent.exists())){
                    parent.mkdirs();
                }
                FileOutputStream fos = new FileOutputStream(file);
                BufferedOutputStream bos = new BufferedOutputStream(fos,BUFFER);           
                
                int count;
                byte data[] = new byte[BUFFER];
                while ((count = bis.read(data, 0, BUFFER)) != -1)
                {
                    bos.write(data, 0, count);
                }
                bos.flush();
                bos.close();
                bis.close();
            }
            zipFile.close();
        } catch (Exception e) {
            e.printStackTrace();
        }
    }
}
